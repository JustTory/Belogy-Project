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
      case 'createpost':
        $PageName = ' | Create post';
        break;
      case 'post':
        $PageName = ' | Post';
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
      case 'createpost':
        $CSSName = 'createpost.css';
        break;
      case 'post':
        $CSSName = 'post.css';
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
      case 'createpost':
        $JSName = 'createpost.js';
        break;
      case 'post':
        $JSName = 'post.js';
        break;
    }
    return $JSName;
  }
?>