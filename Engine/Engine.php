<?php

namespace Engine;

class Engine {
    public Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function start(): void
    {
        $this->router->get('/', function () {
            if (Config::check()) {
                Response::send(Design::upload());
            }
            Response::send(Design::config());
        });

        $this->router->get('/config/reconfigure', function () {
            Config::reconfigure();
            Response::redirect('/');
        });

        $this->router->post('/upload', function () {
            if (empty($_FILES['data']["tmp_name"])) {
                Response::send('Invalid Request', 400);
            }

            $csv = CsvProcessor::read($_FILES['data']["tmp_name"]);
            $data = CsvProcessor::process($csv);
            $file = CsvProcessor::save($data);

            FileManager::download($file);
            FileManager::delete($file);
            Response::send($csv);
        });

        $this->router->post('/config/update', function () {
            if(
                empty($_POST['data'])
                || empty($_POST['format'])
                || !is_array($_POST['format'])
                || count(array_filter($_POST['format'])) == 0
                || !is_array($_POST['data'])
                || count(array_filter($_POST['data'])) == 0
            ) {
                Response::send('Invalid Request', 400);
            }

            Config::process(array_filter($_POST['format']), array_filter($_POST['data']));
            Response::redirect('/');
        });

        Response::send('Page not found', 404);
    }
}