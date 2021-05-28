<?php 

  function PHPNameToPageName($PHPName) {
    switch ($PHPName) {
      case 'index':
        $PageName = '';
        break;
      case 'signin':
        $PageName = ' | Sign In';
        break;
      case 'signup':
        $PageName = ' | Sign Up';
        break;
    }
    return $PageName;
  }

  function PHPNameToCSSName($PHPName) {
    switch ($PHPName) {
      case 'index':
        $CSSName = 'index.css';
        break;
      case 'signin':
        $CSSName = 'signin.css';
        break;
      case 'signup':
        $CSSName = 'signup.css';
        break;
    }
    return $CSSName;
  }

  function PHPNameToJSName($PHPName) {
    switch ($PHPName) {
      case 'index':
        $JSName = 'index.js';
        break;
      case 'signin':
        $JSName = 'login.js';
        break;
      case 'signup':
        $JSName = 'login.js';
        break;
    }
    return $JSName;
  }

//   function pageNameToPHPName($pageName) {
//     switch ($pageName) {
//       case 'Home':
//         $PHPName = 'index';
//         break;
//       case 'About Me':
//         $PHPName = 'aboutme';
//         break;
//       case 'My Gallery':
//         $PHPName = 'mygallery';
//         break;
//     }
//     return $PHPName;
//   }



//   function outputNavLinks($navLinks, $PHPName) {
//     $output = "";
//     foreach ($navLinks as $navLink) {
//       $href = pageNameToPHPName($navLink);
//       if($href == $PHPName) $active = "active";
//       else $active = "";
//       $output .= "<li><a href='{$href}.php' class='{$active}'>{$navLink}</a></li>";
//     }
//     echo $output;
//   }

?>