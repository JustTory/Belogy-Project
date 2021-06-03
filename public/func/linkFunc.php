<?php 
  function PHPNameToPageName($PHPName) {
    switch ($PHPName) {
      case 'index':
        $PageName = 'Belogy';
        break;
      case 'signin':
        $PageName = 'Sign In';
        break;
      case 'signup':
        $PageName = 'Sign Up';
        break;
      case 'createpost':
        $PageName = 'Create Post';
        break;
      case 'post':
        $PageName = 'Post';
        break;
      case 'editpost':
        $PageName = 'Edit Post';
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
      case 'editpost':
        $CSSName = 'editpost.css';
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
      case 'editpost':
        $JSName = 'editpost.js';
        break;
    }
    return $JSName;
  }
?>