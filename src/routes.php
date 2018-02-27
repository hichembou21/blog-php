<?php
use Slim\Http\Request;
use Slim\Http\Response;
// use Slim\Http\UploadedFile;
use app\entities\User;
use app\entities\Article;
use app\dao\DaoUser;
use app\dao\DaoArticle;

$container = $app->getContainer();

// Register provider
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $dao = new DaoUser();
    $users = $dao->getAll();
    // Render index view
    return $this->view->render($response, 'index.twig', [
        'users' => $users
    ]);
})->setName('index');

$app->get('/inscription', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/inscription' route");
    $parsedBody = $request->getParsedBody();
    // Render index view
    return $this->view->render($response, 'inscription.twig', [
        'parsedBody' => $parsedBody
    ]);
})->setName('inscription');

$app->get('/editblog/{id}', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/editblog' route");
    $dao = new DaoUser();
    $daoA = new DaoArticle();
    $user = $dao->getUserById($args['id']);
    $articles = $daoA->getAllUserArticle($user->getId());
    
    // Render index view
    return $this->view->render($response, 'editblog.twig', [
        'user' => $user,
        'articles' => $articles
    ]);
})->setName('editblog');

$app->post('/login', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/login' route");

    $parsedBody = $request->getParsedBody();

    $dao = new DaoUser;
    $daoA = new DaoArticle;

    $user = $dao->getUserByEmail($parsedBody['email']);
    // $cookies = Dflydev\FigCookies\Cookies::fromRequest($request);

    if (isset($user)) {
        $_SESSION['isValide'] = ($parsedBody['email'] === $user->getEmail() && $parsedBody['password'] === $user->getPassword());
        if ($_SESSION['isValide']) {
            $_SESSION['user'] = $user;
            $_SESSION['articles'] = $daoA->getAllUserArticle($user->getId());    
        }
    } else {
        $_SESSION['isValide'] = false;  
    }

    return $this->view->render($response, 'login.twig', [
        'isValide'=> $_SESSION['isValide'],
        'user'=> $_SESSION['user'],
        'articles'=> $_SESSION['articles']
    ]);        
})->setName('login');

$app->get('/login', function (Request $request, Response $response, array $args) {
    // Sample log message
    // $cookie = FigRequestCookies::get($request, 'isValide', true);
    $daoA = new DaoArticle;  

    if (isset($_SESSION['user']) && ($_SESSION['isValide'])) {
        $_SESSION['articles'] = $daoA->getAllUserArticle($_SESSION['user']->getId());
        return $this->view->render($response, 'login.twig', [
            'isValide'=> $_SESSION['isValide'],
            'user'=> $_SESSION['user'],
            'articles' => $_SESSION['articles']
        ]); 
    } else {
        $this->flash->addMessage('error', 'Invalid route');
        $errors['error'] = "Invalid Route";
        $redirectUrl = $this->router->pathFor('index', $errors);
        return $response->withRedirect($redirectUrl); 

    }       
})->setName('login');

$app->post('/inscription', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/inscription' route");
    $parsedBody = $request->getParsedBody();
    
    $dao = new DaoUser;
        
    $user = new User($parsedBody['username'], $parsedBody['blog'], $parsedBody['email'], $parsedBody['password'], intval($parsedBody['gender']), $parsedBody['avatar']);
    $dao->add($user);
    // return $response->withRedirect('/', 301);  
        
    $redirectUrl = $this->router->pathFor('index');
    return $response->withRedirect($redirectUrl);   
    // $parsedBody['isValide'] = ($parsedBody['email'] === "hichem@gmail.com" && $parsedBody['password'] ==="1234");
})->setName('inscription');

$app->post('/addarticle', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/addarticle' route");
    $parsedBody = $request->getParsedBody();
    // $files = $request->getUploadedFiles();
    // if (empty($files['article-picture'])) {
    //     throw new Exception('Expected a newfile');
    // }
    // $newfile = $files['article-picture'];
    // var_dump($newfile);

    $daoA = new DaoArticle;
    $article = new Article($parsedBody['article-title'], $parsedBody['article-content'], $parsedBody['article-picture'], $_SESSION['user']->getId());
    var_dump($article);
    $daoA->add($article, $_SESSION['user']->getId()); 
        
    // $redirectUrl = $this->router->pathFor('login');
    // return $response->withRedirect($redirectUrl); 
    return $this->view->render($response, 'addarticle.twig');        
    
    // $parsedBody['isValide'] = ($parsedBody['email'] === "hichem@gmail.com" && $parsedBody['password'] ==="1234");
})->setName('addarticle');

$app->get('/signout', function (Request $request, Response $response, array $args) {
    // Sample log message
    // $cookie = FigRequestCookies::get($request, 'isValide', true);
    session_destroy();
    $redirectUrl = $this->router->pathFor('index');
    return $response->withRedirect($redirectUrl); 
     
})->setName('signout');

$app->get('/updatearticle/{id}', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/updatearticle' route");
    if (isset($_SESSION['user']) && ($_SESSION['isValide'])) {
        $dao = new DaoArticle();
        $article = $dao->getArticleById($args['id']); 
        return $this->view->render($response, 'updatearticle.twig', [
            'article'=> $article
        ]); 
    } else {
        $redirectUrl = $this->router->pathFor('index');
        return $response->withRedirect($redirectUrl); 
    }
})->setName('updatearticle');

$app->post('/updatearticle/{id}', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/updatearticle' route");
    $parsedBody = $request->getParsedBody();
    
    $dao = new DaoArticle();
    $article = $dao->getArticleById($args['id']);
    $article->setTitle($parsedBody['article-title']);
    $article->setContent($parsedBody['article-content']); 
    $article->setPicture($parsedBody['article-picture']);  
    
    $dao->update($article);
    $_SESSION['articles'] = $dao->getAllUserArticle($_SESSION['user']->getId());
    
    $redirectUrl = $this->router->pathFor('login');
    return $response->withRedirect($redirectUrl); 
})->setName('updatearticle');

$app->get('/deletearticle/{id}', function (Request $request, Response $response, array $args) {
    // Sample log message

    $this->logger->info("Slim-Skeleton '/deletearticle' route");
    
    if (isset($_SESSION['user']) && ($_SESSION['isValide'])) {

        $daoA = new DaoArticle;
        $daoA->delete($args['id']);
        // $_SESSION['articles'] =  $daoA->getAllUserArticle($_SESSION['user']->getId());
        
        $redirectUrl = $this->router->pathFor('login');
        return $response->withRedirect($redirectUrl);         

    } else {
        $redirectUrl = $this->router->pathFor('index');
        return $response->withRedirect($redirectUrl); 
    }
})->setName('deletearticle');

$app->get('/updateuser', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/updateuser' route");

    if (isset($_SESSION['user']) && ($_SESSION['isValide'])) {
        
        return $this->view->render($response, 'updateuser.twig', [
            'user' => $_SESSION['user']
        ]); 
    } else {
        $redirectUrl = $this->router->pathFor('index');
        return $response->withRedirect($redirectUrl); 
    }
})->setName('updateuser');

$app->post('/updateuser', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/updateuser' route");
    $parsedBody = $request->getParsedBody();
    
    $dao = new DaoUser();
    $user = $_SESSION['user'];
    $user->setUsername($parsedBody['username']);
    $user->setPassword($parsedBody['password']);      
    $user->setAvatar($parsedBody['avatar']);  
    
    $dao->update($article);
    $_SESSION['articles'] = $dao->getAllUserArticle($_SESSION['user']->getId());
    
    $redirectUrl = $this->router->pathFor('login');
    return $response->withRedirect($redirectUrl); 
})->setName('updateuser');
