<?php

namespace Classes;

use Classes\Model\BlogModel;
use Symfony\Component\EventDispatcher\Event;

class BlogPage
{
    private $config;

    public function __construct()
    {
        $blogConfigObject = new BlogConfig();
        $this->config = $blogConfigObject->getConfig();
    }

    private function getEntries()
    {
        $blogModelObject = new BlogModel();
        $entries = $blogModelObject->getAllBlogPosts();

        $entryHtml = "";

        $i = 0;
        foreach ($entries as $entry) {
            $entryHtml .= "<div class=\"row\">\n";
            $i++;
            $entryHtml .= "<div class=\"col-md-12\">\n";
            $entryHtml .= "<div><h2>".trim($entry['entry_title'])."</h2></div>\n";
            $entryHtml .= "<div><p>".trim($entry['entry_content'])."</p></div>\n";
            $entryHtml .= "</div>\n";
            $entryHtml .= "</div>\n";
        }

        return $entryHtml;
    }

    private function getHeader()
    {
        $head = "<HTML>\n";
        $head .= "<HEAD>\n";

        if (array_key_exists('page_title', $this->config)) {
            $head .= "\t<TITLE>".$this->config["page_title"]."</TITLE>\n";
        }

        $head .= "<link href=\"bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">";

        $head .= "</HEAD>\n";

        $head .= "<BODY>\n";

        return $head;
    }

    private function getNavigation()
    {
        $nav = '
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">My Blog Posts</a></li>
                <li><a href="#">About Me</a></li>
              </ul>
              <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
               <button type="submit" class="btn btn-default">Submit</button>
              </form>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        ';

        return $nav;
    }

    private function getFooter()
    {
        $footer = "";

        $footer .= "
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\"></script>
        <script src=\"bootstrap/js/bootstrap.min.js\"></script>";

        $footer .= "</BODY>\n";
        $footer .= "</HTML>";

        return $footer;
    }

    private function getH1()
    {
        if (array_key_exists('page_h1', $this->config)) {
            $h1 = '
            <div class="page-header">
              <h1>'.$this->config["page_h1"].' <span class="glyphicon glyphicon-music"></span> <small>Some stuff about me</small> <span class="glyphicon glyphicon-music"></span></h1>
            </div>
            ';

            return $h1;
        }

        return null;
    }

    public function generatePage(Event $configEvent)
    {
        $pageContent = $this->getHeader();

        $pageContent .= $this->getNavigation();

        $pageContent .= $this->getH1();

        $pageContent .= $this->getEntries();

        $pageContent .= $this->getFooter();

        file_put_contents('Web/index.html', $pageContent);
    }
}
