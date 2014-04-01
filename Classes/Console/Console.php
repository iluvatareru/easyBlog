<?php

namespace Classes\Console;

use Classes\BlogConfig;

class Console extends AbstractConsole
{
    CONST PAGE_TITLE = "What is going to be the title of your Web page: \n";
    CONST PAGE_ACTION = <<<EOT
\nPlease select one of these tasks to contine: \n
1 - Enter an entry \n
2 - Enter the title\n
3 - Enter the headline\n
4 - Exit\n
EOT;
    CONST PAGE_H1 = "What is going to be the header of your Web page: \n";

    CONST BLOG_TITLE = "Please enter title of your entry: \n";

    CONST BLOG_CONTENT = "Please enter your entry: \n";

    public function generate($argv = null)
    {
        $bloggerInput = $this->runConsole(self::PAGE_ACTION);

        switch ($bloggerInput) {
            case 1;
                $blogTitle = $this->runConsole(self::BLOG_TITLE);
                $blogContent = $this->runConsole(self::BLOG_CONTENT);
                $this->enterEntity($blogTitle, $blogContent);
                break;
            case 2;
                $bloggerInput = $this->runConsole(self::PAGE_TITLE);
                $this->setConfig("page_title", $bloggerInput);
                break;
            case 3;
                $bloggerInput = $this->runConsole(self::PAGE_H1);
                $this->setConfig("page_h1", $bloggerInput);
                break;
        }

        if ($bloggerInput == 4) {
            return;
        }

        $this->generate();
    }

    private function runConsole($inputMessage)
    {
        $handle = fopen('php://stdout', 'w');
        fwrite($handle, $inputMessage);

        $handle = fopen ("php://stdin", "r");
        $bloggerInput = fgets($handle);

        return $bloggerInput;
    }
}