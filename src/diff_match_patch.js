


<!DOCTYPE html>
<html lang="en" class="">
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# object: http://ogp.me/ns/object# article: http://ogp.me/ns/article# profile: http://ogp.me/ns/profile#">
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta name="viewport" content="width=1020">
    
    
    <title>ace-diff/diff_match_patch.js at master · benkeen/ace-diff</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub">
    <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-114.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-144.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144.png">
    <meta property="fb:app_id" content="1401488693436528">

      <meta content="@github" name="twitter:site" /><meta content="summary" name="twitter:card" /><meta content="benkeen/ace-diff" name="twitter:title" /><meta content="ace-diff - A diff/merging wrapper for Ace Editor built on google-diff-match-patch" name="twitter:description" /><meta content="https://avatars0.githubusercontent.com/u/512116?v=3&amp;s=400" name="twitter:image:src" />
      <meta content="GitHub" property="og:site_name" /><meta content="object" property="og:type" /><meta content="https://avatars0.githubusercontent.com/u/512116?v=3&amp;s=400" property="og:image" /><meta content="benkeen/ace-diff" property="og:title" /><meta content="https://github.com/benkeen/ace-diff" property="og:url" /><meta content="ace-diff - A diff/merging wrapper for Ace Editor built on google-diff-match-patch" property="og:description" />
      <meta name="browser-stats-url" content="https://api.github.com/_private/browser/stats">
    <meta name="browser-errors-url" content="https://api.github.com/_private/browser/errors">
    <link rel="assets" href="https://assets-cdn.github.com/">
    <link rel="web-socket" href="wss://live.github.com/_sockets/MjkwNTYyMzo0YWIxYTU0YjhiMzIyODdlYjQ1MGM3NDBiZTBhYzkxMzowZDE2NzJiNWVjNTAxMzdkOWNmNjJmM2I0M2JjMDc5YzA2ZDRkNmNmNTg0MGYzMWE0NTVlNWM0N2MwMGNhYTQ3--2ffc0f015053a0b4129ec61907f5ab219ecf3ba9">
    <meta name="pjax-timeout" content="1000">
    <link rel="sudo-modal" href="/sessions/sudo_modal">

    <meta name="msapplication-TileImage" content="/windows-tile.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="selected-link" value="repo_source" data-pjax-transient>

    <meta name="google-site-verification" content="KT5gs8h0wvaagLKAVWq8bbeNwnZZK1r1XQysX3xurLU">
        <meta name="google-analytics" content="UA-3769691-2">

    <meta content="collector.githubapp.com" name="octolytics-host" /><meta content="collector-cdn.github.com" name="octolytics-script-host" /><meta content="github" name="octolytics-app-id" /><meta content="BE93B08C:4F9C:7CEF10D:55EEED9E" name="octolytics-dimension-request_id" /><meta content="2905623" name="octolytics-actor-id" /><meta content="cerok" name="octolytics-actor-login" /><meta content="bdf375b679496d99098a3f566490957124b353ed03718bbe2746166146411b19" name="octolytics-actor-hash" />
    
    <meta content="Rails, view, blob#show" data-pjax-transient="true" name="analytics-event" />
    <meta class="js-ga-set" name="dimension1" content="Logged In">
      <meta class="js-ga-set" name="dimension4" content="Current repo nav">
    <meta name="is-dotcom" content="true">
        <meta name="hostname" content="github.com">
    <meta name="user-login" content="cerok">

      <link rel="mask-icon" href="https://assets-cdn.github.com/pinned-octocat.svg" color="#4078c0">
      <link rel="icon" type="image/x-icon" href="https://assets-cdn.github.com/favicon.ico">

    <!-- </textarea> --><!-- '"` --><meta content="authenticity_token" name="csrf-param" />
<meta content="vvZMP9U0AWno0C42R9hoHjKG5E6V/O3vBH3MDxaGNQz+oT6WZnf3l3tWQEKjyJCOu7jsugOvF+zegTJfLeXwIA==" name="csrf-token" />
    <meta content="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" name="form-nonce" />

    <link crossorigin="anonymous" href="https://assets-cdn.github.com/assets/github-20ef81825cb67c29f98949804b58cf91dbf3de37cb09ccaa59c93970272e0b35.css" media="all" rel="stylesheet" />
    <link crossorigin="anonymous" href="https://assets-cdn.github.com/assets/github2-726d0810d308c486e226fbd3d4392b84987fddf613a311c76e816dbaf2461c38.css" media="all" rel="stylesheet" />
    
    


    <meta http-equiv="x-pjax-version" content="e21519a1f589ffb51c1a9b6cfaa2bbfc">

      
  <meta name="description" content="ace-diff - A diff/merging wrapper for Ace Editor built on google-diff-match-patch">
  <meta name="go-import" content="github.com/benkeen/ace-diff git https://github.com/benkeen/ace-diff.git">

  <meta content="512116" name="octolytics-dimension-user_id" /><meta content="benkeen" name="octolytics-dimension-user_login" /><meta content="30996443" name="octolytics-dimension-repository_id" /><meta content="benkeen/ace-diff" name="octolytics-dimension-repository_nwo" /><meta content="true" name="octolytics-dimension-repository_public" /><meta content="false" name="octolytics-dimension-repository_is_fork" /><meta content="30996443" name="octolytics-dimension-repository_network_root_id" /><meta content="benkeen/ace-diff" name="octolytics-dimension-repository_network_root_nwo" />
  <link href="https://github.com/benkeen/ace-diff/commits/master.atom" rel="alternate" title="Recent Commits to ace-diff:master" type="application/atom+xml">

  </head>


  <body class="logged_in  env-production linux vis-public page-blob">
    <a href="#start-of-content" tabindex="1" class="accessibility-aid js-skip-to-content">Skip to content</a>

    
    
    



      <div class="header header-logged-in true" role="banner">
  <div class="container clearfix">

    <a class="header-logo-invertocat" href="https://github.com/" data-hotkey="g d" aria-label="Homepage" data-ga-click="Header, go to dashboard, icon:logo">
  <span class="mega-octicon octicon-mark-github"></span>
</a>


      <div class="site-search repo-scope js-site-search" role="search">
          <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/benkeen/ace-diff/search" class="js-site-search-form" data-global-search-url="/search" data-repo-search-url="/benkeen/ace-diff/search" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
  <label class="js-chromeless-input-container form-control">
    <div class="scope-badge">This repository</div>
    <input type="text"
      class="js-site-search-focus js-site-search-field is-clearable chromeless-input"
      data-hotkey="s"
      name="q"
      placeholder="Search"
      aria-label="Search this repository"
      data-global-scope-placeholder="Search GitHub"
      data-repo-scope-placeholder="Search"
      tabindex="1"
      autocapitalize="off">
  </label>
</form>
      </div>

      <ul class="header-nav left" role="navigation">
        <li class="header-nav-item">
          <a href="/pulls" class="js-selected-navigation-item header-nav-link" data-ga-click="Header, click, Nav menu - item:pulls context:user" data-hotkey="g p" data-selected-links="/pulls /pulls/assigned /pulls/mentioned /pulls">
            Pull requests
</a>        </li>
        <li class="header-nav-item">
          <a href="/issues" class="js-selected-navigation-item header-nav-link" data-ga-click="Header, click, Nav menu - item:issues context:user" data-hotkey="g i" data-selected-links="/issues /issues/assigned /issues/mentioned /issues">
            Issues
</a>        </li>
          <li class="header-nav-item">
            <a class="header-nav-link" href="https://gist.github.com/" data-ga-click="Header, go to gist, text:gist">Gist</a>
          </li>
      </ul>

    
<ul class="header-nav user-nav right" id="user-links">
  <li class="header-nav-item">
      <span class="js-socket-channel js-updatable-content"
        data-channel="notification-changed:cerok"
        data-url="/notifications/header">
      <a href="/notifications" aria-label="You have no unread notifications" class="header-nav-link notification-indicator tooltipped tooltipped-s" data-ga-click="Header, go to notifications, icon:read" data-hotkey="g n">
          <span class="mail-status all-read"></span>
          <span class="octicon octicon-bell"></span>
</a>  </span>

  </li>

  <li class="header-nav-item dropdown js-menu-container">
    <a class="header-nav-link tooltipped tooltipped-s js-menu-target" href="/new"
       aria-label="Create new…"
       data-ga-click="Header, create new, icon:add">
      <span class="octicon octicon-plus left"></span>
      <span class="dropdown-caret"></span>
    </a>

    <div class="dropdown-menu-content js-menu-content">
      <ul class="dropdown-menu dropdown-menu-sw">
        
<a class="dropdown-item" href="/new" data-ga-click="Header, create new repository">
  New repository
</a>


  <a class="dropdown-item" href="/organizations/new" data-ga-click="Header, create new organization">
    New organization
  </a>



  <div class="dropdown-divider"></div>
  <div class="dropdown-header">
    <span title="benkeen/ace-diff">This repository</span>
  </div>
    <a class="dropdown-item" href="/benkeen/ace-diff/issues/new" data-ga-click="Header, create new issue">
      New issue
    </a>

      </ul>
    </div>
  </li>

  <li class="header-nav-item dropdown js-menu-container">
    <a class="header-nav-link name tooltipped tooltipped-s js-menu-target" href="/cerok"
       aria-label="View profile and more"
       data-ga-click="Header, show menu, icon:avatar">
      <img alt="@cerok" class="avatar" height="20" src="https://avatars2.githubusercontent.com/u/2905623?v=3&amp;s=40" width="20" />
      <span class="dropdown-caret"></span>
    </a>

    <div class="dropdown-menu-content js-menu-content">
      <div class="dropdown-menu dropdown-menu-sw">
        <div class="dropdown-header header-nav-current-user css-truncate">
          Signed in as <strong class="css-truncate-target">cerok</strong>
        </div>
        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href="/cerok" data-ga-click="Header, go to profile, text:your profile">
          Your profile
        </a>
        <a class="dropdown-item" href="/stars" data-ga-click="Header, go to starred repos, text:your stars">
          Your stars
        </a>
        <a class="dropdown-item" href="/explore" data-ga-click="Header, go to explore, text:explore">
          Explore
        </a>
        <a class="dropdown-item" href="https://help.github.com" data-ga-click="Header, go to help, text:help">
          Help
        </a>
        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href="/settings/profile" data-ga-click="Header, go to settings, icon:settings">
          Settings
        </a>

        <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/logout" class="logout-form" data-form-nonce="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="G+hp0PeD/DaA6RK0L7Soy+VvydWDN72Z46+Qhy/XmPq1QWMXs0bZcKUaB3uBdONYGmjIQ5/g2M6uQFWVDneGww==" /></div>
          <button class="dropdown-item dropdown-signout" data-ga-click="Header, sign out, icon:logout">
            Sign out
          </button>
</form>      </div>
    </div>
  </li>
</ul>


    
  </div>
</div>

      

      


    <div id="start-of-content" class="accessibility-aid"></div>

    <div id="js-flash-container">
</div>


        <div itemscope itemtype="http://schema.org/WebPage">
    <div class="pagehead repohead instapaper_ignore readability-menu">
      <div class="container">

        <div class="clearfix">
          
<ul class="pagehead-actions">

  <li>
      <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/notifications/subscribe" class="js-social-container" data-autosubmit="true" data-form-nonce="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="KMr+O750uP1QMrHF7Ddn3c/Io1+6BUWDmYLSgV6p7LM2y9VHiMNUFk6zbPs/RJ4Sa5y4R2QECBDyMSvbKdP5sA==" /></div>    <input id="repository_id" name="repository_id" type="hidden" value="30996443" />

      <div class="select-menu js-menu-container js-select-menu">
        <a href="/benkeen/ace-diff/subscription"
          class="btn btn-sm btn-with-count select-menu-button js-menu-target" role="button" tabindex="0" aria-haspopup="true"
          data-ga-click="Repository, click Watch settings, action:blob#show">
          <span class="js-select-button">
            <span class="octicon octicon-eye"></span>
            Watch
          </span>
        </a>
        <a class="social-count js-social-count" href="/benkeen/ace-diff/watchers">
          5
        </a>

        <div class="select-menu-modal-holder">
          <div class="select-menu-modal subscription-menu-modal js-menu-content" aria-hidden="true">
            <div class="select-menu-header">
              <span class="select-menu-title">Notifications</span>
              <span class="octicon octicon-x js-menu-close" role="button" aria-label="Close"></span>
            </div>

            <div class="select-menu-list js-navigation-container" role="menu">

              <div class="select-menu-item js-navigation-item selected" role="menuitem" tabindex="0">
                <span class="select-menu-item-icon octicon octicon-check"></span>
                <div class="select-menu-item-text">
                  <input checked="checked" id="do_included" name="do" type="radio" value="included" />
                  <span class="select-menu-item-heading">Not watching</span>
                  <span class="description">Be notified when participating or @mentioned.</span>
                  <span class="js-select-button-text hidden-select-button-text">
                    <span class="octicon octicon-eye"></span>
                    Watch
                  </span>
                </div>
              </div>

              <div class="select-menu-item js-navigation-item " role="menuitem" tabindex="0">
                <span class="select-menu-item-icon octicon octicon octicon-check"></span>
                <div class="select-menu-item-text">
                  <input id="do_subscribed" name="do" type="radio" value="subscribed" />
                  <span class="select-menu-item-heading">Watching</span>
                  <span class="description">Be notified of all conversations.</span>
                  <span class="js-select-button-text hidden-select-button-text">
                    <span class="octicon octicon-eye"></span>
                    Unwatch
                  </span>
                </div>
              </div>

              <div class="select-menu-item js-navigation-item " role="menuitem" tabindex="0">
                <span class="select-menu-item-icon octicon octicon-check"></span>
                <div class="select-menu-item-text">
                  <input id="do_ignore" name="do" type="radio" value="ignore" />
                  <span class="select-menu-item-heading">Ignoring</span>
                  <span class="description">Never be notified.</span>
                  <span class="js-select-button-text hidden-select-button-text">
                    <span class="octicon octicon-mute"></span>
                    Stop ignoring
                  </span>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
</form>
  </li>

  <li>
    
  <div class="js-toggler-container js-social-container starring-container ">

    <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/benkeen/ace-diff/unstar" class="js-toggler-form starred js-unstar-button" data-form-nonce="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="LsCqsvzCP0dWYvHlpgBDrPUvDcowT1DXT9lZWmybkdsOw1kDaafiL84glAiaTcjKCC7jDBoXN/za3McD7tSF8g==" /></div>
      <button
        class="btn btn-sm btn-with-count js-toggler-target"
        aria-label="Unstar this repository" title="Unstar benkeen/ace-diff"
        data-ga-click="Repository, click unstar button, action:blob#show; text:Unstar">
        <span class="octicon octicon-star"></span>
        Unstar
      </button>
        <a class="social-count js-social-count" href="/benkeen/ace-diff/stargazers">
          32
        </a>
</form>
    <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/benkeen/ace-diff/star" class="js-toggler-form unstarred js-star-button" data-form-nonce="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="EZgBcQvIGnSoeF37jvEAHSjrXsYRiFNeaZU4xVWjO8toqI3epBIYySG/pdg656YsLmKmpPIggpHRiyY9LlrCBA==" /></div>
      <button
        class="btn btn-sm btn-with-count js-toggler-target"
        aria-label="Star this repository" title="Star benkeen/ace-diff"
        data-ga-click="Repository, click star button, action:blob#show; text:Star">
        <span class="octicon octicon-star"></span>
        Star
      </button>
        <a class="social-count js-social-count" href="/benkeen/ace-diff/stargazers">
          32
        </a>
</form>  </div>

  </li>

        <li>
          <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/benkeen/ace-diff/fork" data-form-nonce="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="doh3MrMElqRscnc6H3YCBk78x9o9MSY2r7EdjgQmPm0YU4H2uMzpsF5oDCH2cKv3pPaHbwu9RS/QIo/UbY8ICw==" /></div>
            <button
                type="submit"
                class="btn btn-sm btn-with-count"
                data-ga-click="Repository, show fork modal, action:blob#show; text:Fork"
                title="Fork your own copy of benkeen/ace-diff to your account"
                aria-label="Fork your own copy of benkeen/ace-diff to your account">
              <span class="octicon octicon-repo-forked"></span>
              Fork
            </button>
            <a href="/benkeen/ace-diff/network" class="social-count">9</a>
</form>        </li>

</ul>

          <h1 itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="entry-title public ">
  <span class="mega-octicon octicon-repo"></span>
  <span class="author"><a href="/benkeen" class="url fn" itemprop="url" rel="author"><span itemprop="title">benkeen</span></a></span><!--
--><span class="path-divider">/</span><!--
--><strong><a href="/benkeen/ace-diff" data-pjax="#js-repo-pjax-container">ace-diff</a></strong>

  <span class="page-context-loader">
    <img alt="" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
  </span>

</h1>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="repository-with-sidebar repo-container new-discussion-timeline ">
        <div class="repository-sidebar clearfix">
          
<nav class="sunken-menu repo-nav js-repo-nav js-sidenav-container-pjax js-octicon-loaders"
     role="navigation"
     data-pjax="#js-repo-pjax-container"
     data-issue-count-url="/benkeen/ace-diff/issues/counts">
  <ul class="sunken-menu-group">
    <li class="tooltipped tooltipped-w" aria-label="Code">
      <a href="/benkeen/ace-diff" aria-label="Code" aria-selected="true" class="js-selected-navigation-item selected sunken-menu-item" data-hotkey="g c" data-selected-links="repo_source repo_downloads repo_commits repo_releases repo_tags repo_branches /benkeen/ace-diff">
        <span class="octicon octicon-code"></span> <span class="full-word">Code</span>
        <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>    </li>

      <li class="tooltipped tooltipped-w" aria-label="Issues">
        <a href="/benkeen/ace-diff/issues" aria-label="Issues" class="js-selected-navigation-item sunken-menu-item" data-hotkey="g i" data-selected-links="repo_issues repo_labels repo_milestones /benkeen/ace-diff/issues">
          <span class="octicon octicon-issue-opened"></span> <span class="full-word">Issues</span>
          <span class="js-issue-replace-counter"></span>
          <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>

    <li class="tooltipped tooltipped-w" aria-label="Pull requests">
      <a href="/benkeen/ace-diff/pulls" aria-label="Pull requests" class="js-selected-navigation-item sunken-menu-item" data-hotkey="g p" data-selected-links="repo_pulls /benkeen/ace-diff/pulls">
          <span class="octicon octicon-git-pull-request"></span> <span class="full-word">Pull requests</span>
          <span class="js-pull-replace-counter"></span>
          <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>    </li>

      <li class="tooltipped tooltipped-w" aria-label="Wiki">
        <a href="/benkeen/ace-diff/wiki" aria-label="Wiki" class="js-selected-navigation-item sunken-menu-item" data-hotkey="g w" data-selected-links="repo_wiki /benkeen/ace-diff/wiki">
          <span class="octicon octicon-book"></span> <span class="full-word">Wiki</span>
          <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>      </li>
  </ul>
  <div class="sunken-menu-separator"></div>
  <ul class="sunken-menu-group">

    <li class="tooltipped tooltipped-w" aria-label="Pulse">
      <a href="/benkeen/ace-diff/pulse" aria-label="Pulse" class="js-selected-navigation-item sunken-menu-item" data-selected-links="pulse /benkeen/ace-diff/pulse">
        <span class="octicon octicon-pulse"></span> <span class="full-word">Pulse</span>
        <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>    </li>

    <li class="tooltipped tooltipped-w" aria-label="Graphs">
      <a href="/benkeen/ace-diff/graphs" aria-label="Graphs" class="js-selected-navigation-item sunken-menu-item" data-selected-links="repo_graphs repo_contributors /benkeen/ace-diff/graphs">
        <span class="octicon octicon-graph"></span> <span class="full-word">Graphs</span>
        <img alt="" class="mini-loader" height="16" src="https://assets-cdn.github.com/images/spinners/octocat-spinner-32.gif" width="16" />
</a>    </li>
  </ul>


</nav>

            <div class="only-with-full-nav">
                
<div class="js-clone-url clone-url open"
  data-protocol-type="http">
  <h3><span class="text-emphasized">HTTPS</span> clone URL</h3>
  <div class="input-group js-zeroclipboard-container">
    <input type="text" class="input-mini input-monospace js-url-field js-zeroclipboard-target"
           value="https://github.com/benkeen/ace-diff.git" readonly="readonly" aria-label="HTTPS clone URL">
    <span class="input-group-button">
      <button aria-label="Copy to clipboard" class="js-zeroclipboard btn btn-sm zeroclipboard-button tooltipped tooltipped-s" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
    </span>
  </div>
</div>

  
<div class="js-clone-url clone-url "
  data-protocol-type="ssh">
  <h3><span class="text-emphasized">SSH</span> clone URL</h3>
  <div class="input-group js-zeroclipboard-container">
    <input type="text" class="input-mini input-monospace js-url-field js-zeroclipboard-target"
           value="git@github.com:benkeen/ace-diff.git" readonly="readonly" aria-label="SSH clone URL">
    <span class="input-group-button">
      <button aria-label="Copy to clipboard" class="js-zeroclipboard btn btn-sm zeroclipboard-button tooltipped tooltipped-s" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
    </span>
  </div>
</div>

  
<div class="js-clone-url clone-url "
  data-protocol-type="subversion">
  <h3><span class="text-emphasized">Subversion</span> checkout URL</h3>
  <div class="input-group js-zeroclipboard-container">
    <input type="text" class="input-mini input-monospace js-url-field js-zeroclipboard-target"
           value="https://github.com/benkeen/ace-diff" readonly="readonly" aria-label="Subversion checkout URL">
    <span class="input-group-button">
      <button aria-label="Copy to clipboard" class="js-zeroclipboard btn btn-sm zeroclipboard-button tooltipped tooltipped-s" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
    </span>
  </div>
</div>



  <div class="clone-options">You can clone with
    <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/users/set_protocol?protocol_selector=http&amp;protocol_type=clone" class="inline-form js-clone-selector-form is-enabled" data-form-nonce="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="P/oVVPZ5Qc4jomAfqvIpR0TipacHBvux1IGU7Xyu0qiA+6szK/jIEyVFYUVi1tZwe/mJe1WvnzTw3cc/1GDJfg==" /></div><button class="btn-link js-clone-selector" data-protocol="http" type="submit">HTTPS</button></form>, <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/users/set_protocol?protocol_selector=ssh&amp;protocol_type=clone" class="inline-form js-clone-selector-form is-enabled" data-form-nonce="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="FuU/Cn20O75LmftZk7N/B0nQi6n+SBKakS5c/B0FK994nXCtfRfuG79yivSPkAzTMZh05PMTlyoo6yzvA/6W8Q==" /></div><button class="btn-link js-clone-selector" data-protocol="ssh" type="submit">SSH</button></form>, or <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/users/set_protocol?protocol_selector=subversion&amp;protocol_type=clone" class="inline-form js-clone-selector-form is-enabled" data-form-nonce="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" data-remote="true" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="cvETL651rahGj6k1AxgtnEcrzBZJm3XZ9qTf2Z2aY3s3tBqosyEiN588h4b3ogi52Tg0+8LemKgkHMykLVFZ6g==" /></div><button class="btn-link js-clone-selector" data-protocol="subversion" type="submit">Subversion</button></form>.
    <a href="https://help.github.com/articles/which-remote-url-should-i-use" class="help tooltipped tooltipped-n" aria-label="Get help on which URL is right for you.">
      <span class="octicon octicon-question"></span>
    </a>
  </div>

              <a href="/benkeen/ace-diff/archive/master.zip"
                 class="btn btn-sm sidebar-button"
                 aria-label="Download the contents of benkeen/ace-diff as a zip file"
                 title="Download the contents of benkeen/ace-diff as a zip file"
                 rel="nofollow">
                <span class="octicon octicon-cloud-download"></span>
                Download ZIP
              </a>
            </div>
        </div>
        <div id="js-repo-pjax-container" class="repository-content context-loader-container" data-pjax-container>

          

<a href="/benkeen/ace-diff/blob/9771b1be8b95262ca59ba625c739d24daaff6336/libs/diff_match_patch.js" class="hidden js-permalink-shortcut" data-hotkey="y">Permalink</a>

<!-- blob contrib key: blob_contributors:v21:41bdee70fcb2ba4c92ff3a2e7f8ba8e7 -->

  <div class="file-navigation js-zeroclipboard-container">
    
<div class="select-menu js-menu-container js-select-menu left">
  <span class="btn btn-sm select-menu-button js-menu-target css-truncate" data-hotkey="w"
    data-ref="master"
    title="master"
    role="button" aria-label="Switch branches or tags" tabindex="0" aria-haspopup="true">
    <i>Branch:</i>
    <span class="js-select-button css-truncate-target">master</span>
  </span>

  <div class="select-menu-modal-holder js-menu-content js-navigation-container" data-pjax aria-hidden="true">

    <div class="select-menu-modal">
      <div class="select-menu-header">
        <span class="select-menu-title">Switch branches/tags</span>
        <span class="octicon octicon-x js-menu-close" role="button" aria-label="Close"></span>
      </div>

      <div class="select-menu-filters">
        <div class="select-menu-text-filter">
          <input type="text" aria-label="Filter branches/tags" id="context-commitish-filter-field" class="js-filterable-field js-navigation-enable" placeholder="Filter branches/tags">
        </div>
        <div class="select-menu-tabs">
          <ul>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="branches" data-filter-placeholder="Filter branches/tags" class="js-select-menu-tab" role="tab">Branches</a>
            </li>
            <li class="select-menu-tab">
              <a href="#" data-tab-filter="tags" data-filter-placeholder="Find a tag…" class="js-select-menu-tab" role="tab">Tags</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="branches" role="menu">

        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/benkeen/ace-diff/blob/gh-pages/libs/diff_match_patch.js"
               data-name="gh-pages"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="gh-pages">
                gh-pages
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open selected"
               href="/benkeen/ace-diff/blob/master/libs/diff_match_patch.js"
               data-name="master"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="master">
                master
              </span>
            </a>
            <a class="select-menu-item js-navigation-item js-navigation-open "
               href="/benkeen/ace-diff/blob/scroll_locking/libs/diff_match_patch.js"
               data-name="scroll_locking"
               data-skip-pjax="true"
               rel="nofollow">
              <span class="select-menu-item-icon octicon octicon-check"></span>
              <span class="select-menu-item-text css-truncate-target" title="scroll_locking">
                scroll_locking
              </span>
            </a>
        </div>

          <div class="select-menu-no-results">Nothing to show</div>
      </div>

      <div class="select-menu-list select-menu-tab-bucket js-select-menu-tab-bucket" data-tab-filter="tags">
        <div data-filterable-for="context-commitish-filter-field" data-filterable-type="substring">


        </div>

        <div class="select-menu-no-results">Nothing to show</div>
      </div>

    </div>
  </div>
</div>

    <div class="btn-group right">
      <a href="/benkeen/ace-diff/find/master"
            class="js-show-file-finder btn btn-sm empty-icon tooltipped tooltipped-nw"
            data-pjax
            data-hotkey="t"
            aria-label="Quickly jump between files">
        <span class="octicon octicon-list-unordered"></span>
      </a>
      <button aria-label="Copy file path to clipboard" class="js-zeroclipboard btn btn-sm zeroclipboard-button tooltipped tooltipped-s" data-copied-hint="Copied!" type="button"><span class="octicon octicon-clippy"></span></button>
    </div>

    <div class="breadcrumb js-zeroclipboard-target">
      <span class="repo-root js-repo-root"><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/benkeen/ace-diff" class="" data-branch="master" data-pjax="true" itemscope="url"><span itemprop="title">ace-diff</span></a></span></span><span class="separator">/</span><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/benkeen/ace-diff/tree/master/libs" class="" data-branch="master" data-pjax="true" itemscope="url"><span itemprop="title">libs</span></a></span><span class="separator">/</span><strong class="final-path">diff_match_patch.js</strong>
    </div>
  </div>


  <div class="commit file-history-tease">
    <div class="file-history-tease-header">
        <img alt="@benkeen" class="avatar" height="24" src="https://avatars0.githubusercontent.com/u/512116?v=3&amp;s=48" width="24" />
        <span class="author"><a href="/benkeen" rel="author">benkeen</a></span>
        <time datetime="2015-02-19T03:09:09Z" is="relative-time">Feb 18, 2015</time>
        <div class="commit-title">
            <a href="/benkeen/ace-diff/commit/e76e84db5989b6d4069ae70ebaad507cfec82b15" class="message" data-pjax="true" title="initial test">initial test</a>
        </div>
    </div>

    <div class="participation">
      <p class="quickstat">
        <a href="#blob_contributors_box" rel="facebox">
          <strong>1</strong>
           contributor
        </a>
      </p>
      
    </div>
    <div id="blob_contributors_box" style="display:none">
      <h2 class="facebox-header" data-facebox-id="facebox-header">Users who have contributed to this file</h2>
      <ul class="facebox-user-list" data-facebox-id="facebox-description">
          <li class="facebox-user-list-item">
            <img alt="@benkeen" height="24" src="https://avatars0.githubusercontent.com/u/512116?v=3&amp;s=48" width="24" />
            <a href="/benkeen">benkeen</a>
          </li>
      </ul>
    </div>
  </div>

<div class="file">
  <div class="file-header">
    <div class="file-actions">

      <div class="btn-group">
        <a href="/benkeen/ace-diff/raw/master/libs/diff_match_patch.js" class="btn btn-sm " id="raw-url">Raw</a>
          <a href="/benkeen/ace-diff/blame/master/libs/diff_match_patch.js" class="btn btn-sm js-update-url-with-hash">Blame</a>
        <a href="/benkeen/ace-diff/commits/master/libs/diff_match_patch.js" class="btn btn-sm " rel="nofollow">History</a>
      </div>


            <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/benkeen/ace-diff/edit/master/libs/diff_match_patch.js" class="inline-form" data-form-nonce="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="wnjvVkOAE4qx9LLxy/l47dxXIO3tmb3dKVdjIL5T9eeTKXV1ys2+k7x9w0dQvuyieBHwf3SsyQc2oN4FbjY60g==" /></div>
              <button class="octicon-btn tooltipped tooltipped-n" type="submit" aria-label="Fork this project and edit the file" data-hotkey="e" data-disable-with>
                <span class="octicon octicon-pencil"></span>
              </button>
</form>
          <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="/benkeen/ace-diff/delete/master/libs/diff_match_patch.js" class="inline-form" data-form-nonce="01601d03ad42f8df6a6bd37769e2bb7fc90729a9" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="PiUnnVIWo6RYFz6Sf2E4gjM2+ZYb3VcwAUMDKlICqL7xZHbWYcRLByQspGwEI0+kLAcDPtayC3Iz0QrzLdtKHg==" /></div>
            <button class="octicon-btn octicon-btn-danger tooltipped tooltipped-n" type="submit" aria-label="Fork this project and delete this file" data-disable-with>
              <span class="octicon octicon-trashcan"></span>
            </button>
</form>    </div>

    <div class="file-info">
        50 lines (49 sloc)
        <span class="file-info-divider"></span>
      19.322 kB
    </div>
  </div>
  

  <div class="blob-wrapper data type-javascript">
      <table class="highlight tab-size js-file-line-container" data-tab-size="8">
      <tr>
        <td id="L1" class="blob-num js-line-number" data-line-number="1"></td>
        <td id="LC1" class="blob-code blob-code-inner js-file-line">(<span class="pl-k">function</span>(){<span class="pl-k">function</span> <span class="pl-en">diff_match_patch</span>(){<span class="pl-v">this</span>.Diff_Timeout<span class="pl-k">=</span><span class="pl-c1">1</span>;<span class="pl-v">this</span>.Diff_EditCost<span class="pl-k">=</span><span class="pl-c1">4</span>;<span class="pl-v">this</span>.Match_Threshold<span class="pl-k">=</span><span class="pl-c1">0.5</span>;<span class="pl-v">this</span>.Match_Distance<span class="pl-k">=</span><span class="pl-c1">1E3</span>;<span class="pl-v">this</span>.Patch_DeleteThreshold<span class="pl-k">=</span><span class="pl-c1">0.5</span>;<span class="pl-v">this</span>.Patch_Margin<span class="pl-k">=</span><span class="pl-c1">4</span>;<span class="pl-v">this</span>.Match_MaxBits<span class="pl-k">=</span><span class="pl-c1">32</span>}</td>
      </tr>
      <tr>
        <td id="L2" class="blob-num js-line-number" data-line-number="2"></td>
        <td id="LC2" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_main</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>,<span class="pl-smi">c</span>,<span class="pl-smi">d</span>){<span class="pl-s"><span class="pl-pds">&quot;</span>undefined<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> d<span class="pl-k">&amp;&amp;</span>(d<span class="pl-k">=</span><span class="pl-c1">0</span><span class="pl-k">&gt;=</span><span class="pl-v">this</span>.Diff_Timeout<span class="pl-k">?</span><span class="pl-c1">Number</span>.<span class="pl-c1">MAX_VALUE</span><span class="pl-k">:</span>(<span class="pl-k">new</span> <span class="pl-en">Date</span>).<span class="pl-c1">getTime</span>()<span class="pl-k">+</span><span class="pl-c1">1E3</span><span class="pl-k">*</span><span class="pl-v">this</span>.Diff_Timeout);<span class="pl-k">if</span>(<span class="pl-c1">null</span><span class="pl-k">==</span>a<span class="pl-k">||</span><span class="pl-c1">null</span><span class="pl-k">==</span>b)<span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&quot;</span>Null input. (diff_main)<span class="pl-pds">&quot;</span></span>);<span class="pl-k">if</span>(a<span class="pl-k">==</span>b)<span class="pl-k">return</span> a<span class="pl-k">?</span>[[<span class="pl-c1">0</span>,a]]<span class="pl-k">:</span>[];<span class="pl-s"><span class="pl-pds">&quot;</span>undefined<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> c<span class="pl-k">&amp;&amp;</span>(c<span class="pl-k">=!</span><span class="pl-c1">0</span>);<span class="pl-k">var</span> e<span class="pl-k">=</span>c,f<span class="pl-k">=</span><span class="pl-v">this</span>.diff_commonPrefix(a,b);c<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,f);a<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(f);b<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(f);<span class="pl-k">var</span> f<span class="pl-k">=</span><span class="pl-v">this</span>.diff_commonSuffix(a,b),g<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(a.<span class="pl-c1">length</span><span class="pl-k">-</span>f);a<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,a.<span class="pl-c1">length</span><span class="pl-k">-</span>f);b<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,b.<span class="pl-c1">length</span><span class="pl-k">-</span>f);a<span class="pl-k">=</span><span class="pl-v">this</span>.diff_compute_(a,</td>
      </tr>
      <tr>
        <td id="L3" class="blob-num js-line-number" data-line-number="3"></td>
        <td id="LC3" class="blob-code blob-code-inner js-file-line">    b,e,d);c<span class="pl-k">&amp;&amp;</span>a.<span class="pl-c1">unshift</span>([<span class="pl-c1">0</span>,c]);g<span class="pl-k">&amp;&amp;</span>a.<span class="pl-c1">push</span>([<span class="pl-c1">0</span>,g]);<span class="pl-v">this</span>.diff_cleanupMerge(a);<span class="pl-k">return</span> a};</td>
      </tr>
      <tr>
        <td id="L4" class="blob-num js-line-number" data-line-number="4"></td>
        <td id="LC4" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_compute_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>,<span class="pl-smi">c</span>,<span class="pl-smi">d</span>){<span class="pl-k">if</span>(<span class="pl-k">!</span>a)<span class="pl-k">return</span>[[<span class="pl-c1">1</span>,b]];<span class="pl-k">if</span>(<span class="pl-k">!</span>b)<span class="pl-k">return</span>[[<span class="pl-k">-</span><span class="pl-c1">1</span>,a]];<span class="pl-k">var</span> e<span class="pl-k">=</span>a.<span class="pl-c1">length</span><span class="pl-k">&gt;</span>b.<span class="pl-c1">length</span><span class="pl-k">?</span>a<span class="pl-k">:</span>b,f<span class="pl-k">=</span>a.<span class="pl-c1">length</span><span class="pl-k">&gt;</span>b.<span class="pl-c1">length</span><span class="pl-k">?</span>b<span class="pl-k">:</span>a,g<span class="pl-k">=</span>e.<span class="pl-c1">indexOf</span>(f);<span class="pl-k">return</span><span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">!=</span>g<span class="pl-k">?</span>(c<span class="pl-k">=</span>[[<span class="pl-c1">1</span>,e.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,g)],[<span class="pl-c1">0</span>,f],[<span class="pl-c1">1</span>,e.<span class="pl-c1">substring</span>(g<span class="pl-k">+</span>f.<span class="pl-c1">length</span>)]],a.<span class="pl-c1">length</span><span class="pl-k">&gt;</span>b.<span class="pl-c1">length</span><span class="pl-k">&amp;&amp;</span>(c[<span class="pl-c1">0</span>][<span class="pl-c1">0</span>]<span class="pl-k">=</span>c[<span class="pl-c1">2</span>][<span class="pl-c1">0</span>]<span class="pl-k">=-</span><span class="pl-c1">1</span>),c)<span class="pl-k">:</span><span class="pl-c1">1</span><span class="pl-k">==</span>f.<span class="pl-c1">length</span><span class="pl-k">?</span>[[<span class="pl-k">-</span><span class="pl-c1">1</span>,a],[<span class="pl-c1">1</span>,b]]<span class="pl-k">:</span>(e<span class="pl-k">=</span><span class="pl-v">this</span>.diff_halfMatch_(a,b))<span class="pl-k">?</span>(f<span class="pl-k">=</span>e[<span class="pl-c1">0</span>],a<span class="pl-k">=</span>e[<span class="pl-c1">1</span>],g<span class="pl-k">=</span>e[<span class="pl-c1">2</span>],b<span class="pl-k">=</span>e[<span class="pl-c1">3</span>],e<span class="pl-k">=</span>e[<span class="pl-c1">4</span>],f<span class="pl-k">=</span><span class="pl-v">this</span>.diff_main(f,g,c,d),c<span class="pl-k">=</span><span class="pl-v">this</span>.diff_main(a,b,c,d),f.<span class="pl-c1">concat</span>([[<span class="pl-c1">0</span>,e]],c))<span class="pl-k">:</span>c<span class="pl-k">&amp;&amp;</span><span class="pl-c1">100</span><span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span><span class="pl-k">&amp;&amp;</span><span class="pl-c1">100</span><span class="pl-k">&lt;</span>b.<span class="pl-c1">length</span><span class="pl-k">?</span><span class="pl-v">this</span>.diff_lineMode_(a,b,</td>
      </tr>
      <tr>
        <td id="L5" class="blob-num js-line-number" data-line-number="5"></td>
        <td id="LC5" class="blob-code blob-code-inner js-file-line">    d)<span class="pl-k">:</span><span class="pl-v">this</span>.diff_bisect_(a,b,d)};</td>
      </tr>
      <tr>
        <td id="L6" class="blob-num js-line-number" data-line-number="6"></td>
        <td id="LC6" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_lineMode_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>,<span class="pl-smi">c</span>){<span class="pl-k">var</span> d<span class="pl-k">=</span><span class="pl-v">this</span>.diff_linesToChars_(a,b);a<span class="pl-k">=</span>d.chars1;b<span class="pl-k">=</span>d.chars2;d<span class="pl-k">=</span>d.lineArray;a<span class="pl-k">=</span><span class="pl-v">this</span>.diff_main(a,b,<span class="pl-k">!</span><span class="pl-c1">1</span>,c);<span class="pl-v">this</span>.diff_charsToLines_(a,d);<span class="pl-v">this</span>.diff_cleanupSemantic(a);a.<span class="pl-c1">push</span>([<span class="pl-c1">0</span>,<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>]);<span class="pl-k">for</span>(<span class="pl-k">var</span> e<span class="pl-k">=</span>d<span class="pl-k">=</span>b<span class="pl-k">=</span><span class="pl-c1">0</span>,f<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>,g<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>;b<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;){<span class="pl-k">switch</span>(a[b][<span class="pl-c1">0</span>]){<span class="pl-k">case</span> <span class="pl-c1">1</span><span class="pl-k">:</span>e<span class="pl-k">++</span>;g<span class="pl-k">+=</span>a[b][<span class="pl-c1">1</span>];<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">:</span>d<span class="pl-k">++</span>;f<span class="pl-k">+=</span>a[b][<span class="pl-c1">1</span>];<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-c1">0</span><span class="pl-k">:</span><span class="pl-k">if</span>(<span class="pl-c1">1</span><span class="pl-k">&lt;=</span>d<span class="pl-k">&amp;&amp;</span><span class="pl-c1">1</span><span class="pl-k">&lt;=</span>e){a.<span class="pl-c1">splice</span>(b<span class="pl-k">-</span>d<span class="pl-k">-</span>e,d<span class="pl-k">+</span>e);b<span class="pl-k">=</span>b<span class="pl-k">-</span>d<span class="pl-k">-</span>e;d<span class="pl-k">=</span><span class="pl-v">this</span>.diff_main(f,g,<span class="pl-k">!</span><span class="pl-c1">1</span>,c);<span class="pl-k">for</span>(e<span class="pl-k">=</span>d.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>;<span class="pl-c1">0</span><span class="pl-k">&lt;=</span>e;e<span class="pl-k">--</span>)a.<span class="pl-c1">splice</span>(b,<span class="pl-c1">0</span>,d[e]);b<span class="pl-k">+=</span>d.<span class="pl-c1">length</span>}d<span class="pl-k">=</span>e<span class="pl-k">=</span><span class="pl-c1">0</span>;g<span class="pl-k">=</span>f<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>}b<span class="pl-k">++</span>}a.<span class="pl-c1">pop</span>();<span class="pl-k">return</span> a};</td>
      </tr>
      <tr>
        <td id="L7" class="blob-num js-line-number" data-line-number="7"></td>
        <td id="LC7" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_bisect_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>,<span class="pl-smi">c</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> d<span class="pl-k">=</span>a.<span class="pl-c1">length</span>,e<span class="pl-k">=</span>b.<span class="pl-c1">length</span>,f<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">ceil</span>((d<span class="pl-k">+</span>e)<span class="pl-k">/</span><span class="pl-c1">2</span>),g<span class="pl-k">=</span>f,h<span class="pl-k">=</span><span class="pl-c1">2</span><span class="pl-k">*</span>f,j<span class="pl-k">=</span><span class="pl-c1">Array</span>(h),i<span class="pl-k">=</span><span class="pl-c1">Array</span>(h),k<span class="pl-k">=</span><span class="pl-c1">0</span>;k<span class="pl-k">&lt;</span>h;k<span class="pl-k">++</span>)j[k]<span class="pl-k">=-</span><span class="pl-c1">1</span>,i[k]<span class="pl-k">=-</span><span class="pl-c1">1</span>;j[g<span class="pl-k">+</span><span class="pl-c1">1</span>]<span class="pl-k">=</span><span class="pl-c1">0</span>;i[g<span class="pl-k">+</span><span class="pl-c1">1</span>]<span class="pl-k">=</span><span class="pl-c1">0</span>;<span class="pl-k">for</span>(<span class="pl-k">var</span> k<span class="pl-k">=</span>d<span class="pl-k">-</span>e,q<span class="pl-k">=</span><span class="pl-c1">0</span><span class="pl-k">!=</span>k<span class="pl-k">%</span><span class="pl-c1">2</span>,r<span class="pl-k">=</span><span class="pl-c1">0</span>,t<span class="pl-k">=</span><span class="pl-c1">0</span>,p<span class="pl-k">=</span><span class="pl-c1">0</span>,w<span class="pl-k">=</span><span class="pl-c1">0</span>,v<span class="pl-k">=</span><span class="pl-c1">0</span>;v<span class="pl-k">&lt;</span>f<span class="pl-k">&amp;&amp;!</span>((<span class="pl-k">new</span> <span class="pl-en">Date</span>).<span class="pl-c1">getTime</span>()<span class="pl-k">&gt;</span>c);v<span class="pl-k">++</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> n<span class="pl-k">=-</span>v<span class="pl-k">+</span>r;n<span class="pl-k">&lt;=</span>v<span class="pl-k">-</span>t;n<span class="pl-k">+=</span><span class="pl-c1">2</span>){<span class="pl-k">var</span> l<span class="pl-k">=</span>g<span class="pl-k">+</span>n,m;m<span class="pl-k">=</span>n<span class="pl-k">==-</span>v<span class="pl-k">||</span>n<span class="pl-k">!=</span>v<span class="pl-k">&amp;&amp;</span>j[l<span class="pl-k">-</span><span class="pl-c1">1</span>]<span class="pl-k">&lt;</span>j[l<span class="pl-k">+</span><span class="pl-c1">1</span>]<span class="pl-k">?</span>j[l<span class="pl-k">+</span><span class="pl-c1">1</span>]<span class="pl-k">:</span>j[l<span class="pl-k">-</span><span class="pl-c1">1</span>]<span class="pl-k">+</span><span class="pl-c1">1</span>;<span class="pl-k">for</span>(<span class="pl-k">var</span> s<span class="pl-k">=</span>m<span class="pl-k">-</span>n;m<span class="pl-k">&lt;</span>d<span class="pl-k">&amp;&amp;</span>s<span class="pl-k">&lt;</span>e<span class="pl-k">&amp;&amp;</span>a.<span class="pl-c1">charAt</span>(m)<span class="pl-k">==</span>b.<span class="pl-c1">charAt</span>(s);)m<span class="pl-k">++</span>,s<span class="pl-k">++</span>;j[l]<span class="pl-k">=</span>m;<span class="pl-k">if</span>(m<span class="pl-k">&gt;</span>d)t<span class="pl-k">+=</span><span class="pl-c1">2</span>;<span class="pl-k">else</span> <span class="pl-k">if</span>(s<span class="pl-k">&gt;</span>e)r<span class="pl-k">+=</span><span class="pl-c1">2</span>;<span class="pl-k">else</span> <span class="pl-k">if</span>(q<span class="pl-k">&amp;&amp;</span>(l<span class="pl-k">=</span>g<span class="pl-k">+</span>k<span class="pl-k">-</span>n,<span class="pl-c1">0</span><span class="pl-k">&lt;=</span>l<span class="pl-k">&amp;&amp;</span>l<span class="pl-k">&lt;</span>h<span class="pl-k">&amp;&amp;-</span><span class="pl-c1">1</span><span class="pl-k">!=</span>i[l])){<span class="pl-k">var</span> u<span class="pl-k">=</span>d<span class="pl-k">-</span>i[l];<span class="pl-k">if</span>(m<span class="pl-k">&gt;=</span></td>
      </tr>
      <tr>
        <td id="L8" class="blob-num js-line-number" data-line-number="8"></td>
        <td id="LC8" class="blob-code blob-code-inner js-file-line">    u)<span class="pl-k">return</span> <span class="pl-v">this</span>.diff_bisectSplit_(a,b,m,s,c)}}<span class="pl-k">for</span>(n<span class="pl-k">=-</span>v<span class="pl-k">+</span>p;n<span class="pl-k">&lt;=</span>v<span class="pl-k">-</span>w;n<span class="pl-k">+=</span><span class="pl-c1">2</span>){l<span class="pl-k">=</span>g<span class="pl-k">+</span>n;u<span class="pl-k">=</span>n<span class="pl-k">==-</span>v<span class="pl-k">||</span>n<span class="pl-k">!=</span>v<span class="pl-k">&amp;&amp;</span>i[l<span class="pl-k">-</span><span class="pl-c1">1</span>]<span class="pl-k">&lt;</span>i[l<span class="pl-k">+</span><span class="pl-c1">1</span>]<span class="pl-k">?</span>i[l<span class="pl-k">+</span><span class="pl-c1">1</span>]<span class="pl-k">:</span>i[l<span class="pl-k">-</span><span class="pl-c1">1</span>]<span class="pl-k">+</span><span class="pl-c1">1</span>;<span class="pl-k">for</span>(m<span class="pl-k">=</span>u<span class="pl-k">-</span>n;u<span class="pl-k">&lt;</span>d<span class="pl-k">&amp;&amp;</span>m<span class="pl-k">&lt;</span>e<span class="pl-k">&amp;&amp;</span>a.<span class="pl-c1">charAt</span>(d<span class="pl-k">-</span>u<span class="pl-k">-</span><span class="pl-c1">1</span>)<span class="pl-k">==</span>b.<span class="pl-c1">charAt</span>(e<span class="pl-k">-</span>m<span class="pl-k">-</span><span class="pl-c1">1</span>);)u<span class="pl-k">++</span>,m<span class="pl-k">++</span>;i[l]<span class="pl-k">=</span>u;<span class="pl-k">if</span>(u<span class="pl-k">&gt;</span>d)w<span class="pl-k">+=</span><span class="pl-c1">2</span>;<span class="pl-k">else</span> <span class="pl-k">if</span>(m<span class="pl-k">&gt;</span>e)p<span class="pl-k">+=</span><span class="pl-c1">2</span>;<span class="pl-k">else</span> <span class="pl-k">if</span>(<span class="pl-k">!</span>q<span class="pl-k">&amp;&amp;</span>(l<span class="pl-k">=</span>g<span class="pl-k">+</span>k<span class="pl-k">-</span>n,<span class="pl-c1">0</span><span class="pl-k">&lt;=</span>l<span class="pl-k">&amp;&amp;</span>(l<span class="pl-k">&lt;</span>h<span class="pl-k">&amp;&amp;-</span><span class="pl-c1">1</span><span class="pl-k">!=</span>j[l])<span class="pl-k">&amp;&amp;</span>(m<span class="pl-k">=</span>j[l],s<span class="pl-k">=</span>g<span class="pl-k">+</span>m<span class="pl-k">-</span>l,u<span class="pl-k">=</span>d<span class="pl-k">-</span>u,m<span class="pl-k">&gt;=</span>u)))<span class="pl-k">return</span> <span class="pl-v">this</span>.diff_bisectSplit_(a,b,m,s,c)}}<span class="pl-k">return</span>[[<span class="pl-k">-</span><span class="pl-c1">1</span>,a],[<span class="pl-c1">1</span>,b]]};</td>
      </tr>
      <tr>
        <td id="L9" class="blob-num js-line-number" data-line-number="9"></td>
        <td id="LC9" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_bisectSplit_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>,<span class="pl-smi">c</span>,<span class="pl-smi">d</span>,<span class="pl-smi">e</span>){<span class="pl-k">var</span> f<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,c),g<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,d);a<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(c);b<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(d);f<span class="pl-k">=</span><span class="pl-v">this</span>.diff_main(f,g,<span class="pl-k">!</span><span class="pl-c1">1</span>,e);e<span class="pl-k">=</span><span class="pl-v">this</span>.diff_main(a,b,<span class="pl-k">!</span><span class="pl-c1">1</span>,e);<span class="pl-k">return</span> f.<span class="pl-c1">concat</span>(e)};</td>
      </tr>
      <tr>
        <td id="L10" class="blob-num js-line-number" data-line-number="10"></td>
        <td id="LC10" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_linesToChars_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">function</span> <span class="pl-en">c</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>,c<span class="pl-k">=</span><span class="pl-c1">0</span>,f<span class="pl-k">=-</span><span class="pl-c1">1</span>,g<span class="pl-k">=</span>d.<span class="pl-c1">length</span>;f<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>;){f<span class="pl-k">=</span>a.<span class="pl-c1">indexOf</span>(<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>,c);<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">==</span>f<span class="pl-k">&amp;&amp;</span>(f<span class="pl-k">=</span>a.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>);<span class="pl-k">var</span> r<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(c,f<span class="pl-k">+</span><span class="pl-c1">1</span>),c<span class="pl-k">=</span>f<span class="pl-k">+</span><span class="pl-c1">1</span>;(e.hasOwnProperty<span class="pl-k">?</span>e.hasOwnProperty(r)<span class="pl-k">:void</span> <span class="pl-c1">0</span><span class="pl-k">!==</span>e[r])<span class="pl-k">?</span>b<span class="pl-k">+=</span><span class="pl-c1">String</span>.<span class="pl-c1">fromCharCode</span>(e[r])<span class="pl-k">:</span>(b<span class="pl-k">+=</span><span class="pl-c1">String</span>.<span class="pl-c1">fromCharCode</span>(g),e[r]<span class="pl-k">=</span>g,d[g<span class="pl-k">++</span>]<span class="pl-k">=</span>r)}<span class="pl-k">return</span> b}<span class="pl-k">var</span> d<span class="pl-k">=</span>[],e<span class="pl-k">=</span>{};d[<span class="pl-c1">0</span>]<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>;<span class="pl-k">var</span> f<span class="pl-k">=</span>c(a),g<span class="pl-k">=</span>c(b);<span class="pl-k">return</span>{chars1<span class="pl-k">:</span>f,chars2<span class="pl-k">:</span>g,lineArray<span class="pl-k">:</span>d}};</td>
      </tr>
      <tr>
        <td id="L11" class="blob-num js-line-number" data-line-number="11"></td>
        <td id="LC11" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_charsToLines_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> c<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;c<span class="pl-k">++</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> d<span class="pl-k">=</span>a[c][<span class="pl-c1">1</span>],e<span class="pl-k">=</span>[],f<span class="pl-k">=</span><span class="pl-c1">0</span>;f<span class="pl-k">&lt;</span>d.<span class="pl-c1">length</span>;f<span class="pl-k">++</span>)e[f]<span class="pl-k">=</span>b[d.<span class="pl-c1">charCodeAt</span>(f)];a[c][<span class="pl-c1">1</span>]<span class="pl-k">=</span>e.<span class="pl-c1">join</span>(<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>)}};<span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_commonPrefix</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">if</span>(<span class="pl-k">!</span>a<span class="pl-k">||!</span>b<span class="pl-k">||</span>a.<span class="pl-c1">charAt</span>(<span class="pl-c1">0</span>)<span class="pl-k">!=</span>b.<span class="pl-c1">charAt</span>(<span class="pl-c1">0</span>))<span class="pl-k">return</span> <span class="pl-c1">0</span>;<span class="pl-k">for</span>(<span class="pl-k">var</span> c<span class="pl-k">=</span><span class="pl-c1">0</span>,d<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">min</span>(a.<span class="pl-c1">length</span>,b.<span class="pl-c1">length</span>),e<span class="pl-k">=</span>d,f<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>e;)a.<span class="pl-c1">substring</span>(f,e)<span class="pl-k">==</span>b.<span class="pl-c1">substring</span>(f,e)<span class="pl-k">?</span>f<span class="pl-k">=</span>c<span class="pl-k">=</span>e<span class="pl-k">:</span>d<span class="pl-k">=</span>e,e<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">floor</span>((d<span class="pl-k">-</span>c)<span class="pl-k">/</span><span class="pl-c1">2</span><span class="pl-k">+</span>c);<span class="pl-k">return</span> e};</td>
      </tr>
      <tr>
        <td id="L12" class="blob-num js-line-number" data-line-number="12"></td>
        <td id="LC12" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_commonSuffix</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">if</span>(<span class="pl-k">!</span>a<span class="pl-k">||!</span>b<span class="pl-k">||</span>a.<span class="pl-c1">charAt</span>(a.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>)<span class="pl-k">!=</span>b.<span class="pl-c1">charAt</span>(b.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>))<span class="pl-k">return</span> <span class="pl-c1">0</span>;<span class="pl-k">for</span>(<span class="pl-k">var</span> c<span class="pl-k">=</span><span class="pl-c1">0</span>,d<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">min</span>(a.<span class="pl-c1">length</span>,b.<span class="pl-c1">length</span>),e<span class="pl-k">=</span>d,f<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>e;)a.<span class="pl-c1">substring</span>(a.<span class="pl-c1">length</span><span class="pl-k">-</span>e,a.<span class="pl-c1">length</span><span class="pl-k">-</span>f)<span class="pl-k">==</span>b.<span class="pl-c1">substring</span>(b.<span class="pl-c1">length</span><span class="pl-k">-</span>e,b.<span class="pl-c1">length</span><span class="pl-k">-</span>f)<span class="pl-k">?</span>f<span class="pl-k">=</span>c<span class="pl-k">=</span>e<span class="pl-k">:</span>d<span class="pl-k">=</span>e,e<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">floor</span>((d<span class="pl-k">-</span>c)<span class="pl-k">/</span><span class="pl-c1">2</span><span class="pl-k">+</span>c);<span class="pl-k">return</span> e};</td>
      </tr>
      <tr>
        <td id="L13" class="blob-num js-line-number" data-line-number="13"></td>
        <td id="LC13" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_commonOverlap_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">var</span> c<span class="pl-k">=</span>a.<span class="pl-c1">length</span>,d<span class="pl-k">=</span>b.<span class="pl-c1">length</span>;<span class="pl-k">if</span>(<span class="pl-c1">0</span><span class="pl-k">==</span>c<span class="pl-k">||</span><span class="pl-c1">0</span><span class="pl-k">==</span>d)<span class="pl-k">return</span> <span class="pl-c1">0</span>;c<span class="pl-k">&gt;</span>d<span class="pl-k">?</span>a<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(c<span class="pl-k">-</span>d)<span class="pl-k">:</span>c<span class="pl-k">&lt;</span>d<span class="pl-k">&amp;&amp;</span>(b<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,c));c<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">min</span>(c,d);<span class="pl-k">if</span>(a<span class="pl-k">==</span>b)<span class="pl-k">return</span> c;<span class="pl-k">for</span>(<span class="pl-k">var</span> d<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span><span class="pl-c1">1</span>;;){<span class="pl-k">var</span> f<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(c<span class="pl-k">-</span>e),f<span class="pl-k">=</span>b.<span class="pl-c1">indexOf</span>(f);<span class="pl-k">if</span>(<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">==</span>f)<span class="pl-k">return</span> d;e<span class="pl-k">+=</span>f;<span class="pl-k">if</span>(<span class="pl-c1">0</span><span class="pl-k">==</span>f<span class="pl-k">||</span>a.<span class="pl-c1">substring</span>(c<span class="pl-k">-</span>e)<span class="pl-k">==</span>b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,e))d<span class="pl-k">=</span>e,e<span class="pl-k">++</span>}};</td>
      </tr>
      <tr>
        <td id="L14" class="blob-num js-line-number" data-line-number="14"></td>
        <td id="LC14" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_halfMatch_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">function</span> <span class="pl-en">c</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>,<span class="pl-smi">c</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> d<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(c,c<span class="pl-k">+</span><span class="pl-c1">Math</span>.<span class="pl-c1">floor</span>(a.<span class="pl-c1">length</span><span class="pl-k">/</span><span class="pl-c1">4</span>)),e<span class="pl-k">=-</span><span class="pl-c1">1</span>,g<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>,h,j,n,l;<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">!=</span>(e<span class="pl-k">=</span>b.<span class="pl-c1">indexOf</span>(d,e<span class="pl-k">+</span><span class="pl-c1">1</span>));){<span class="pl-k">var</span> m<span class="pl-k">=</span>f.diff_commonPrefix(a.<span class="pl-c1">substring</span>(c),b.<span class="pl-c1">substring</span>(e)),s<span class="pl-k">=</span>f.diff_commonSuffix(a.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,c),b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,e));g.<span class="pl-c1">length</span><span class="pl-k">&lt;</span>s<span class="pl-k">+</span>m<span class="pl-k">&amp;&amp;</span>(g<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(e<span class="pl-k">-</span>s,e)<span class="pl-k">+</span>b.<span class="pl-c1">substring</span>(e,e<span class="pl-k">+</span>m),h<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,c<span class="pl-k">-</span>s),j<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(c<span class="pl-k">+</span>m),n<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,e<span class="pl-k">-</span>s),l<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(e<span class="pl-k">+</span>m))}<span class="pl-k">return</span> <span class="pl-c1">2</span><span class="pl-k">*</span>g.<span class="pl-c1">length</span><span class="pl-k">&gt;=</span>a.<span class="pl-c1">length</span><span class="pl-k">?</span>[h,j,n,l,g]<span class="pl-k">:</span><span class="pl-c1">null</span>}<span class="pl-k">if</span>(<span class="pl-c1">0</span><span class="pl-k">&gt;=</span><span class="pl-v">this</span>.Diff_Timeout)<span class="pl-k">return</span> <span class="pl-c1">null</span>;</td>
      </tr>
      <tr>
        <td id="L15" class="blob-num js-line-number" data-line-number="15"></td>
        <td id="LC15" class="blob-code blob-code-inner js-file-line">    <span class="pl-k">var</span> d<span class="pl-k">=</span>a.<span class="pl-c1">length</span><span class="pl-k">&gt;</span>b.<span class="pl-c1">length</span><span class="pl-k">?</span>a<span class="pl-k">:</span>b,e<span class="pl-k">=</span>a.<span class="pl-c1">length</span><span class="pl-k">&gt;</span>b.<span class="pl-c1">length</span><span class="pl-k">?</span>b<span class="pl-k">:</span>a;<span class="pl-k">if</span>(<span class="pl-c1">4</span><span class="pl-k">&gt;</span>d.<span class="pl-c1">length</span><span class="pl-k">||</span><span class="pl-c1">2</span><span class="pl-k">*</span>e.<span class="pl-c1">length</span><span class="pl-k">&lt;</span>d.<span class="pl-c1">length</span>)<span class="pl-k">return</span> <span class="pl-c1">null</span>;<span class="pl-k">var</span> f<span class="pl-k">=</span><span class="pl-v">this</span>,g<span class="pl-k">=</span>c(d,e,<span class="pl-c1">Math</span>.<span class="pl-c1">ceil</span>(d.<span class="pl-c1">length</span><span class="pl-k">/</span><span class="pl-c1">4</span>)),d<span class="pl-k">=</span>c(d,e,<span class="pl-c1">Math</span>.<span class="pl-c1">ceil</span>(d.<span class="pl-c1">length</span><span class="pl-k">/</span><span class="pl-c1">2</span>)),h;<span class="pl-k">if</span>(<span class="pl-k">!</span>g<span class="pl-k">&amp;&amp;!</span>d)<span class="pl-k">return</span> <span class="pl-c1">null</span>;h<span class="pl-k">=</span>d<span class="pl-k">?</span>g<span class="pl-k">?</span>g[<span class="pl-c1">4</span>].<span class="pl-c1">length</span><span class="pl-k">&gt;</span>d[<span class="pl-c1">4</span>].<span class="pl-c1">length</span><span class="pl-k">?</span>g<span class="pl-k">:</span>d<span class="pl-k">:</span>d<span class="pl-k">:</span>g;<span class="pl-k">var</span> j;a.<span class="pl-c1">length</span><span class="pl-k">&gt;</span>b.<span class="pl-c1">length</span><span class="pl-k">?</span>(g<span class="pl-k">=</span>h[<span class="pl-c1">0</span>],d<span class="pl-k">=</span>h[<span class="pl-c1">1</span>],e<span class="pl-k">=</span>h[<span class="pl-c1">2</span>],j<span class="pl-k">=</span>h[<span class="pl-c1">3</span>])<span class="pl-k">:</span>(e<span class="pl-k">=</span>h[<span class="pl-c1">0</span>],j<span class="pl-k">=</span>h[<span class="pl-c1">1</span>],g<span class="pl-k">=</span>h[<span class="pl-c1">2</span>],d<span class="pl-k">=</span>h[<span class="pl-c1">3</span>]);h<span class="pl-k">=</span>h[<span class="pl-c1">4</span>];<span class="pl-k">return</span>[g,d,e,j,h]};</td>
      </tr>
      <tr>
        <td id="L16" class="blob-num js-line-number" data-line-number="16"></td>
        <td id="LC16" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_cleanupSemantic</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=!</span><span class="pl-c1">1</span>,c<span class="pl-k">=</span>[],d<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span><span class="pl-c1">null</span>,f<span class="pl-k">=</span><span class="pl-c1">0</span>,g<span class="pl-k">=</span><span class="pl-c1">0</span>,h<span class="pl-k">=</span><span class="pl-c1">0</span>,j<span class="pl-k">=</span><span class="pl-c1">0</span>,i<span class="pl-k">=</span><span class="pl-c1">0</span>;f<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;)<span class="pl-c1">0</span><span class="pl-k">==</span>a[f][<span class="pl-c1">0</span>]<span class="pl-k">?</span>(c[d<span class="pl-k">++</span>]<span class="pl-k">=</span>f,g<span class="pl-k">=</span>j,h<span class="pl-k">=</span>i,i<span class="pl-k">=</span>j<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span>a[f][<span class="pl-c1">1</span>])<span class="pl-k">:</span>(<span class="pl-c1">1</span><span class="pl-k">==</span>a[f][<span class="pl-c1">0</span>]<span class="pl-k">?</span>j<span class="pl-k">+=</span>a[f][<span class="pl-c1">1</span>].<span class="pl-c1">length</span><span class="pl-k">:</span>i<span class="pl-k">+=</span>a[f][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>,e<span class="pl-k">&amp;&amp;</span>(e.<span class="pl-c1">length</span><span class="pl-k">&lt;=</span><span class="pl-c1">Math</span>.<span class="pl-c1">max</span>(g,h)<span class="pl-k">&amp;&amp;</span>e.<span class="pl-c1">length</span><span class="pl-k">&lt;=</span><span class="pl-c1">Math</span>.<span class="pl-c1">max</span>(j,i))<span class="pl-k">&amp;&amp;</span>(a.<span class="pl-c1">splice</span>(c[d<span class="pl-k">-</span><span class="pl-c1">1</span>],<span class="pl-c1">0</span>,[<span class="pl-k">-</span><span class="pl-c1">1</span>,e]),a[c[d<span class="pl-k">-</span><span class="pl-c1">1</span>]<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">=</span><span class="pl-c1">1</span>,d<span class="pl-k">--</span>,d<span class="pl-k">--</span>,f<span class="pl-k">=</span><span class="pl-c1">0</span><span class="pl-k">&lt;</span>d<span class="pl-k">?</span>c[d<span class="pl-k">-</span><span class="pl-c1">1</span>]<span class="pl-k">:-</span><span class="pl-c1">1</span>,i<span class="pl-k">=</span>j<span class="pl-k">=</span>h<span class="pl-k">=</span>g<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span><span class="pl-c1">null</span>,b<span class="pl-k">=!</span><span class="pl-c1">0</span>)),f<span class="pl-k">++</span>;b<span class="pl-k">&amp;&amp;</span><span class="pl-v">this</span>.diff_cleanupMerge(a);<span class="pl-v">this</span>.diff_cleanupSemanticLossless(a);<span class="pl-k">for</span>(f<span class="pl-k">=</span><span class="pl-c1">1</span>;f<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;){<span class="pl-k">if</span>(<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">==</span>a[f<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span><span class="pl-c1">1</span><span class="pl-k">==</span>a[f][<span class="pl-c1">0</span>]){b<span class="pl-k">=</span>a[f<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>];c<span class="pl-k">=</span>a[f][<span class="pl-c1">1</span>];</td>
      </tr>
      <tr>
        <td id="L17" class="blob-num js-line-number" data-line-number="17"></td>
        <td id="LC17" class="blob-code blob-code-inner js-file-line">    d<span class="pl-k">=</span><span class="pl-v">this</span>.diff_commonOverlap_(b,c);e<span class="pl-k">=</span><span class="pl-v">this</span>.diff_commonOverlap_(c,b);<span class="pl-k">if</span>(d<span class="pl-k">&gt;=</span>e){<span class="pl-k">if</span>(d<span class="pl-k">&gt;=</span>b.<span class="pl-c1">length</span><span class="pl-k">/</span><span class="pl-c1">2</span><span class="pl-k">||</span>d<span class="pl-k">&gt;=</span>c.<span class="pl-c1">length</span><span class="pl-k">/</span><span class="pl-c1">2</span>)a.<span class="pl-c1">splice</span>(f,<span class="pl-c1">0</span>,[<span class="pl-c1">0</span>,c.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,d)]),a[f<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,b.<span class="pl-c1">length</span><span class="pl-k">-</span>d),a[f<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">=</span>c.<span class="pl-c1">substring</span>(d),f<span class="pl-k">++</span>}<span class="pl-k">else</span> <span class="pl-k">if</span>(e<span class="pl-k">&gt;=</span>b.<span class="pl-c1">length</span><span class="pl-k">/</span><span class="pl-c1">2</span><span class="pl-k">||</span>e<span class="pl-k">&gt;=</span>c.<span class="pl-c1">length</span><span class="pl-k">/</span><span class="pl-c1">2</span>)a.<span class="pl-c1">splice</span>(f,<span class="pl-c1">0</span>,[<span class="pl-c1">0</span>,b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,e)]),a[f<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">=</span><span class="pl-c1">1</span>,a[f<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">=</span>c.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,c.<span class="pl-c1">length</span><span class="pl-k">-</span>e),a[f<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">=-</span><span class="pl-c1">1</span>,a[f<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(e),f<span class="pl-k">++</span>;f<span class="pl-k">++</span>}f<span class="pl-k">++</span>}};</td>
      </tr>
      <tr>
        <td id="L18" class="blob-num js-line-number" data-line-number="18"></td>
        <td id="LC18" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_cleanupSemanticLossless</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">function</span> <span class="pl-en">b</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">if</span>(<span class="pl-k">!</span>a<span class="pl-k">||!</span>b)<span class="pl-k">return</span> <span class="pl-c1">6</span>;<span class="pl-k">var</span> c<span class="pl-k">=</span>a.<span class="pl-c1">charAt</span>(a.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>),d<span class="pl-k">=</span>b.<span class="pl-c1">charAt</span>(<span class="pl-c1">0</span>),e<span class="pl-k">=</span>c.<span class="pl-c1">match</span>(diff_match_patch.nonAlphaNumericRegex_),f<span class="pl-k">=</span>d.<span class="pl-c1">match</span>(diff_match_patch.nonAlphaNumericRegex_),g<span class="pl-k">=</span>e<span class="pl-k">&amp;&amp;</span>c.<span class="pl-c1">match</span>(diff_match_patch.whitespaceRegex_),h<span class="pl-k">=</span>f<span class="pl-k">&amp;&amp;</span>d.<span class="pl-c1">match</span>(diff_match_patch.whitespaceRegex_),c<span class="pl-k">=</span>g<span class="pl-k">&amp;&amp;</span>c.<span class="pl-c1">match</span>(diff_match_patch.linebreakRegex_),d<span class="pl-k">=</span>h<span class="pl-k">&amp;&amp;</span>d.<span class="pl-c1">match</span>(diff_match_patch.linebreakRegex_),i<span class="pl-k">=</span>c<span class="pl-k">&amp;&amp;</span>a.<span class="pl-c1">match</span>(diff_match_patch.blanklineEndRegex_),j<span class="pl-k">=</span>d<span class="pl-k">&amp;&amp;</span>b.<span class="pl-c1">match</span>(diff_match_patch.blanklineStartRegex_);</td>
      </tr>
      <tr>
        <td id="L19" class="blob-num js-line-number" data-line-number="19"></td>
        <td id="LC19" class="blob-code blob-code-inner js-file-line">    <span class="pl-k">return</span> i<span class="pl-k">||</span>j<span class="pl-k">?</span><span class="pl-c1">5</span><span class="pl-k">:</span>c<span class="pl-k">||</span>d<span class="pl-k">?</span><span class="pl-c1">4</span><span class="pl-k">:</span>e<span class="pl-k">&amp;&amp;!</span>g<span class="pl-k">&amp;&amp;</span>h<span class="pl-k">?</span><span class="pl-c1">3</span><span class="pl-k">:</span>g<span class="pl-k">||</span>h<span class="pl-k">?</span><span class="pl-c1">2</span><span class="pl-k">:</span>e<span class="pl-k">||</span>f<span class="pl-k">?</span><span class="pl-c1">1</span><span class="pl-k">:</span><span class="pl-c1">0</span>}<span class="pl-k">for</span>(<span class="pl-k">var</span> c<span class="pl-k">=</span><span class="pl-c1">1</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>;){<span class="pl-k">if</span>(<span class="pl-c1">0</span><span class="pl-k">==</span>a[c<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span><span class="pl-c1">0</span><span class="pl-k">==</span>a[c<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]){<span class="pl-k">var</span> d<span class="pl-k">=</span>a[c<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>],e<span class="pl-k">=</span>a[c][<span class="pl-c1">1</span>],f<span class="pl-k">=</span>a[c<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>],g<span class="pl-k">=</span><span class="pl-v">this</span>.diff_commonSuffix(d,e);<span class="pl-k">if</span>(g)<span class="pl-k">var</span> h<span class="pl-k">=</span>e.<span class="pl-c1">substring</span>(e.<span class="pl-c1">length</span><span class="pl-k">-</span>g),d<span class="pl-k">=</span>d.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,d.<span class="pl-c1">length</span><span class="pl-k">-</span>g),e<span class="pl-k">=</span>h<span class="pl-k">+</span>e.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,e.<span class="pl-c1">length</span><span class="pl-k">-</span>g),f<span class="pl-k">=</span>h<span class="pl-k">+</span>f;<span class="pl-k">for</span>(<span class="pl-k">var</span> g<span class="pl-k">=</span>d,h<span class="pl-k">=</span>e,j<span class="pl-k">=</span>f,i<span class="pl-k">=</span>b(d,e)<span class="pl-k">+</span>b(e,f);e.<span class="pl-c1">charAt</span>(<span class="pl-c1">0</span>)<span class="pl-k">===</span>f.<span class="pl-c1">charAt</span>(<span class="pl-c1">0</span>);){<span class="pl-k">var</span> d<span class="pl-k">=</span>d<span class="pl-k">+</span>e.<span class="pl-c1">charAt</span>(<span class="pl-c1">0</span>),e<span class="pl-k">=</span>e.<span class="pl-c1">substring</span>(<span class="pl-c1">1</span>)<span class="pl-k">+</span>f.<span class="pl-c1">charAt</span>(<span class="pl-c1">0</span>),f<span class="pl-k">=</span>f.<span class="pl-c1">substring</span>(<span class="pl-c1">1</span>),k<span class="pl-k">=</span>b(d,e)<span class="pl-k">+</span>b(e,f);k<span class="pl-k">&gt;=</span>i<span class="pl-k">&amp;&amp;</span>(i<span class="pl-k">=</span>k,g<span class="pl-k">=</span>d,h<span class="pl-k">=</span>e,j<span class="pl-k">=</span>f)}a[c<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">!=</span>g<span class="pl-k">&amp;&amp;</span>(g<span class="pl-k">?</span>a[c<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">=</span>g<span class="pl-k">:</span>(a.<span class="pl-c1">splice</span>(c<span class="pl-k">-</span><span class="pl-c1">1</span>,<span class="pl-c1">1</span>),c<span class="pl-k">--</span>),a[c][<span class="pl-c1">1</span>]<span class="pl-k">=</span></td>
      </tr>
      <tr>
        <td id="L20" class="blob-num js-line-number" data-line-number="20"></td>
        <td id="LC20" class="blob-code blob-code-inner js-file-line">    h,j<span class="pl-k">?</span>a[c<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">=</span>j<span class="pl-k">:</span>(a.<span class="pl-c1">splice</span>(c<span class="pl-k">+</span><span class="pl-c1">1</span>,<span class="pl-c1">1</span>),c<span class="pl-k">--</span>))}c<span class="pl-k">++</span>}};diff_match_patch.nonAlphaNumericRegex_<span class="pl-k">=</span><span class="pl-sr"><span class="pl-pds">/</span><span class="pl-c1">[<span class="pl-k">^</span><span class="pl-c1">a-zA-Z0-9</span>]</span><span class="pl-pds">/</span></span>;diff_match_patch.whitespaceRegex_<span class="pl-k">=</span><span class="pl-sr"><span class="pl-pds">/</span><span class="pl-c1">\s</span><span class="pl-pds">/</span></span>;diff_match_patch.linebreakRegex_<span class="pl-k">=</span><span class="pl-sr"><span class="pl-pds">/</span><span class="pl-c1">[<span class="pl-cce">\r\n</span>]</span><span class="pl-pds">/</span></span>;diff_match_patch.blanklineEndRegex_<span class="pl-k">=</span><span class="pl-sr"><span class="pl-pds">/</span><span class="pl-cce">\n\r</span><span class="pl-k">?</span><span class="pl-cce">\n</span><span class="pl-k">$</span><span class="pl-pds">/</span></span>;diff_match_patch.blanklineStartRegex_<span class="pl-k">=</span><span class="pl-sr"><span class="pl-pds">/</span><span class="pl-k">^</span><span class="pl-cce">\r</span><span class="pl-k">?</span><span class="pl-cce">\n\r</span><span class="pl-k">?</span><span class="pl-cce">\n</span><span class="pl-pds">/</span></span>;</td>
      </tr>
      <tr>
        <td id="L21" class="blob-num js-line-number" data-line-number="21"></td>
        <td id="LC21" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_cleanupEfficiency</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=!</span><span class="pl-c1">1</span>,c<span class="pl-k">=</span>[],d<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span><span class="pl-c1">null</span>,f<span class="pl-k">=</span><span class="pl-c1">0</span>,g<span class="pl-k">=!</span><span class="pl-c1">1</span>,h<span class="pl-k">=!</span><span class="pl-c1">1</span>,j<span class="pl-k">=!</span><span class="pl-c1">1</span>,i<span class="pl-k">=!</span><span class="pl-c1">1</span>;f<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;){<span class="pl-k">if</span>(<span class="pl-c1">0</span><span class="pl-k">==</span>a[f][<span class="pl-c1">0</span>])a[f][<span class="pl-c1">1</span>].<span class="pl-c1">length</span><span class="pl-k">&lt;</span><span class="pl-v">this</span>.Diff_EditCost<span class="pl-k">&amp;&amp;</span>(j<span class="pl-k">||</span>i)<span class="pl-k">?</span>(c[d<span class="pl-k">++</span>]<span class="pl-k">=</span>f,g<span class="pl-k">=</span>j,h<span class="pl-k">=</span>i,e<span class="pl-k">=</span>a[f][<span class="pl-c1">1</span>])<span class="pl-k">:</span>(d<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span><span class="pl-c1">null</span>),j<span class="pl-k">=</span>i<span class="pl-k">=!</span><span class="pl-c1">1</span>;<span class="pl-k">else</span> <span class="pl-k">if</span>(<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">==</span>a[f][<span class="pl-c1">0</span>]<span class="pl-k">?</span>i<span class="pl-k">=!</span><span class="pl-c1">0</span><span class="pl-k">:</span>j<span class="pl-k">=!</span><span class="pl-c1">0</span>,e<span class="pl-k">&amp;&amp;</span>(g<span class="pl-k">&amp;&amp;</span>h<span class="pl-k">&amp;&amp;</span>j<span class="pl-k">&amp;&amp;</span>i<span class="pl-k">||</span>e.<span class="pl-c1">length</span><span class="pl-k">&lt;</span><span class="pl-v">this</span>.Diff_EditCost<span class="pl-k">/</span><span class="pl-c1">2</span><span class="pl-k">&amp;&amp;</span><span class="pl-c1">3</span><span class="pl-k">==</span>g<span class="pl-k">+</span>h<span class="pl-k">+</span>j<span class="pl-k">+</span>i))a.<span class="pl-c1">splice</span>(c[d<span class="pl-k">-</span><span class="pl-c1">1</span>],<span class="pl-c1">0</span>,[<span class="pl-k">-</span><span class="pl-c1">1</span>,e]),a[c[d<span class="pl-k">-</span><span class="pl-c1">1</span>]<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">=</span><span class="pl-c1">1</span>,d<span class="pl-k">--</span>,e<span class="pl-k">=</span><span class="pl-c1">null</span>,g<span class="pl-k">&amp;&amp;</span>h<span class="pl-k">?</span>(j<span class="pl-k">=</span>i<span class="pl-k">=!</span><span class="pl-c1">0</span>,d<span class="pl-k">=</span><span class="pl-c1">0</span>)<span class="pl-k">:</span>(d<span class="pl-k">--</span>,f<span class="pl-k">=</span><span class="pl-c1">0</span><span class="pl-k">&lt;</span>d<span class="pl-k">?</span>c[d<span class="pl-k">-</span><span class="pl-c1">1</span>]<span class="pl-k">:-</span><span class="pl-c1">1</span>,j<span class="pl-k">=</span>i<span class="pl-k">=!</span><span class="pl-c1">1</span>),b<span class="pl-k">=!</span><span class="pl-c1">0</span>;f<span class="pl-k">++</span>}b<span class="pl-k">&amp;&amp;</span><span class="pl-v">this</span>.diff_cleanupMerge(a)};</td>
      </tr>
      <tr>
        <td id="L22" class="blob-num js-line-number" data-line-number="22"></td>
        <td id="LC22" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_cleanupMerge</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){a.<span class="pl-c1">push</span>([<span class="pl-c1">0</span>,<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>]);<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span><span class="pl-c1">0</span>,c<span class="pl-k">=</span><span class="pl-c1">0</span>,d<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>,f<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>,g;b<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;)<span class="pl-k">switch</span>(a[b][<span class="pl-c1">0</span>]){<span class="pl-k">case</span> <span class="pl-c1">1</span><span class="pl-k">:</span>d<span class="pl-k">++</span>;f<span class="pl-k">+=</span>a[b][<span class="pl-c1">1</span>];b<span class="pl-k">++</span>;<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">:</span>c<span class="pl-k">++</span>;e<span class="pl-k">+=</span>a[b][<span class="pl-c1">1</span>];b<span class="pl-k">++</span>;<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-c1">0</span><span class="pl-k">:</span><span class="pl-c1">1</span><span class="pl-k">&lt;</span>c<span class="pl-k">+</span>d<span class="pl-k">?</span>(<span class="pl-c1">0</span><span class="pl-k">!==</span>c<span class="pl-k">&amp;&amp;</span><span class="pl-c1">0</span><span class="pl-k">!==</span>d<span class="pl-k">&amp;&amp;</span>(g<span class="pl-k">=</span><span class="pl-v">this</span>.diff_commonPrefix(f,e),<span class="pl-c1">0</span><span class="pl-k">!==</span>g<span class="pl-k">&amp;&amp;</span>(<span class="pl-c1">0</span><span class="pl-k">&lt;</span>b<span class="pl-k">-</span>c<span class="pl-k">-</span>d<span class="pl-k">&amp;&amp;</span><span class="pl-c1">0</span><span class="pl-k">==</span>a[b<span class="pl-k">-</span>c<span class="pl-k">-</span>d<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">?</span>a[b<span class="pl-k">-</span>c<span class="pl-k">-</span>d<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">+=</span>f.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,g)<span class="pl-k">:</span>(a.<span class="pl-c1">splice</span>(<span class="pl-c1">0</span>,<span class="pl-c1">0</span>,[<span class="pl-c1">0</span>,f.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,g)]),b<span class="pl-k">++</span>),f<span class="pl-k">=</span>f.<span class="pl-c1">substring</span>(g),e<span class="pl-k">=</span>e.<span class="pl-c1">substring</span>(g)),g<span class="pl-k">=</span><span class="pl-v">this</span>.diff_commonSuffix(f,e),<span class="pl-c1">0</span><span class="pl-k">!==</span>g<span class="pl-k">&amp;&amp;</span>(a[b][<span class="pl-c1">1</span>]<span class="pl-k">=</span>f.<span class="pl-c1">substring</span>(f.<span class="pl-c1">length</span><span class="pl-k">-</span>g)<span class="pl-k">+</span>a[b][<span class="pl-c1">1</span>],f<span class="pl-k">=</span>f.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,f.<span class="pl-c1">length</span><span class="pl-k">-</span></td>
      </tr>
      <tr>
        <td id="L23" class="blob-num js-line-number" data-line-number="23"></td>
        <td id="LC23" class="blob-code blob-code-inner js-file-line">  g),e<span class="pl-k">=</span>e.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,e.<span class="pl-c1">length</span><span class="pl-k">-</span>g))),<span class="pl-c1">0</span><span class="pl-k">===</span>c<span class="pl-k">?</span>a.<span class="pl-c1">splice</span>(b<span class="pl-k">-</span>d,c<span class="pl-k">+</span>d,[<span class="pl-c1">1</span>,f])<span class="pl-k">:</span><span class="pl-c1">0</span><span class="pl-k">===</span>d<span class="pl-k">?</span>a.<span class="pl-c1">splice</span>(b<span class="pl-k">-</span>c,c<span class="pl-k">+</span>d,[<span class="pl-k">-</span><span class="pl-c1">1</span>,e])<span class="pl-k">:</span>a.<span class="pl-c1">splice</span>(b<span class="pl-k">-</span>c<span class="pl-k">-</span>d,c<span class="pl-k">+</span>d,[<span class="pl-k">-</span><span class="pl-c1">1</span>,e],[<span class="pl-c1">1</span>,f]),b<span class="pl-k">=</span>b<span class="pl-k">-</span>c<span class="pl-k">-</span>d<span class="pl-k">+</span>(c<span class="pl-k">?</span><span class="pl-c1">1</span><span class="pl-k">:</span><span class="pl-c1">0</span>)<span class="pl-k">+</span>(d<span class="pl-k">?</span><span class="pl-c1">1</span><span class="pl-k">:</span><span class="pl-c1">0</span>)<span class="pl-k">+</span><span class="pl-c1">1</span>)<span class="pl-k">:</span><span class="pl-c1">0</span><span class="pl-k">!==</span>b<span class="pl-k">&amp;&amp;</span><span class="pl-c1">0</span><span class="pl-k">==</span>a[b<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">?</span>(a[b<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">+=</span>a[b][<span class="pl-c1">1</span>],a.<span class="pl-c1">splice</span>(b,<span class="pl-c1">1</span>))<span class="pl-k">:</span>b<span class="pl-k">++</span>,c<span class="pl-k">=</span>d<span class="pl-k">=</span><span class="pl-c1">0</span>,f<span class="pl-k">=</span>e<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>}<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span><span class="pl-k">===</span>a[a.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">&amp;&amp;</span>a.<span class="pl-c1">pop</span>();c<span class="pl-k">=!</span><span class="pl-c1">1</span>;<span class="pl-k">for</span>(b<span class="pl-k">=</span><span class="pl-c1">1</span>;b<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>;)<span class="pl-c1">0</span><span class="pl-k">==</span>a[b<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span><span class="pl-c1">0</span><span class="pl-k">==</span>a[b<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span>(a[b][<span class="pl-c1">1</span>].<span class="pl-c1">substring</span>(a[b][<span class="pl-c1">1</span>].<span class="pl-c1">length</span><span class="pl-k">-</span>a[b<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>)<span class="pl-k">==</span>a[b<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">?</span>(a[b][<span class="pl-c1">1</span>]<span class="pl-k">=</span>a[b<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">+</span>a[b][<span class="pl-c1">1</span>].<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,a[b][<span class="pl-c1">1</span>].<span class="pl-c1">length</span><span class="pl-k">-</span>a[b<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>),a[b<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">=</span>a[b<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">+</span>a[b<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>],a.<span class="pl-c1">splice</span>(b<span class="pl-k">-</span><span class="pl-c1">1</span>,<span class="pl-c1">1</span>),c<span class="pl-k">=!</span><span class="pl-c1">0</span>)<span class="pl-k">:</span>a[b][<span class="pl-c1">1</span>].<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,</td>
      </tr>
      <tr>
        <td id="L24" class="blob-num js-line-number" data-line-number="24"></td>
        <td id="LC24" class="blob-code blob-code-inner js-file-line">    a[b<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>)<span class="pl-k">==</span>a[b<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">&amp;&amp;</span>(a[b<span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">+=</span>a[b<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>],a[b][<span class="pl-c1">1</span>]<span class="pl-k">=</span>a[b][<span class="pl-c1">1</span>].<span class="pl-c1">substring</span>(a[b<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>)<span class="pl-k">+</span>a[b<span class="pl-k">+</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>],a.<span class="pl-c1">splice</span>(b<span class="pl-k">+</span><span class="pl-c1">1</span>,<span class="pl-c1">1</span>),c<span class="pl-k">=!</span><span class="pl-c1">0</span>)),b<span class="pl-k">++</span>;c<span class="pl-k">&amp;&amp;</span><span class="pl-v">this</span>.diff_cleanupMerge(a)};<span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_xIndex</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">var</span> c<span class="pl-k">=</span><span class="pl-c1">0</span>,d<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span><span class="pl-c1">0</span>,f<span class="pl-k">=</span><span class="pl-c1">0</span>,g;<span class="pl-k">for</span>(g<span class="pl-k">=</span><span class="pl-c1">0</span>;g<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;g<span class="pl-k">++</span>){<span class="pl-c1">1</span><span class="pl-k">!==</span>a[g][<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span>(c<span class="pl-k">+=</span>a[g][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>);<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">!==</span>a[g][<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span>(d<span class="pl-k">+=</span>a[g][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>);<span class="pl-k">if</span>(c<span class="pl-k">&gt;</span>b)<span class="pl-k">break</span>;e<span class="pl-k">=</span>c;f<span class="pl-k">=</span>d}<span class="pl-k">return</span> a.<span class="pl-c1">length</span><span class="pl-k">!=</span>g<span class="pl-k">&amp;&amp;-</span><span class="pl-c1">1</span><span class="pl-k">===</span>a[g][<span class="pl-c1">0</span>]<span class="pl-k">?</span>f<span class="pl-k">:</span>f<span class="pl-k">+</span>(b<span class="pl-k">-</span>e)};</td>
      </tr>
      <tr>
        <td id="L25" class="blob-num js-line-number" data-line-number="25"></td>
        <td id="LC25" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_prettyHtml</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span>[],c<span class="pl-k">=</span><span class="pl-sr"><span class="pl-pds">/</span>&amp;<span class="pl-pds">/</span>g</span>,d<span class="pl-k">=</span><span class="pl-sr"><span class="pl-pds">/</span>&lt;<span class="pl-pds">/</span>g</span>,e<span class="pl-k">=</span><span class="pl-sr"><span class="pl-pds">/</span>&gt;<span class="pl-pds">/</span>g</span>,f<span class="pl-k">=</span><span class="pl-sr"><span class="pl-pds">/</span><span class="pl-cce">\n</span><span class="pl-pds">/</span>g</span>,g<span class="pl-k">=</span><span class="pl-c1">0</span>;g<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;g<span class="pl-k">++</span>){<span class="pl-k">var</span> h<span class="pl-k">=</span>a[g][<span class="pl-c1">0</span>],j<span class="pl-k">=</span>a[g][<span class="pl-c1">1</span>],j<span class="pl-k">=</span>j.<span class="pl-c1">replace</span>(c,<span class="pl-s"><span class="pl-pds">&quot;</span>&amp;amp;<span class="pl-pds">&quot;</span></span>).<span class="pl-c1">replace</span>(d,<span class="pl-s"><span class="pl-pds">&quot;</span>&amp;lt;<span class="pl-pds">&quot;</span></span>).<span class="pl-c1">replace</span>(e,<span class="pl-s"><span class="pl-pds">&quot;</span>&amp;gt;<span class="pl-pds">&quot;</span></span>).<span class="pl-c1">replace</span>(f,<span class="pl-s"><span class="pl-pds">&quot;</span>&amp;para;&lt;br&gt;<span class="pl-pds">&quot;</span></span>);<span class="pl-k">switch</span>(h){<span class="pl-k">case</span> <span class="pl-c1">1</span><span class="pl-k">:</span>b[g]<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&#39;</span>&lt;ins style=&quot;background:#e6ffe6;&quot;&gt;<span class="pl-pds">&#39;</span></span><span class="pl-k">+</span>j<span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span>&lt;/ins&gt;<span class="pl-pds">&quot;</span></span>;<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">:</span>b[g]<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&#39;</span>&lt;del style=&quot;background:#ffe6e6;&quot;&gt;<span class="pl-pds">&#39;</span></span><span class="pl-k">+</span>j<span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span>&lt;/del&gt;<span class="pl-pds">&quot;</span></span>;<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-c1">0</span><span class="pl-k">:</span>b[g]<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span>&lt;span&gt;<span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>j<span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span>&lt;/span&gt;<span class="pl-pds">&quot;</span></span>}}<span class="pl-k">return</span> b.<span class="pl-c1">join</span>(<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>)};</td>
      </tr>
      <tr>
        <td id="L26" class="blob-num js-line-number" data-line-number="26"></td>
        <td id="LC26" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_text1</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span>[],c<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;c<span class="pl-k">++</span>)<span class="pl-c1">1</span><span class="pl-k">!==</span>a[c][<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span>(b[c]<span class="pl-k">=</span>a[c][<span class="pl-c1">1</span>]);<span class="pl-k">return</span> b.<span class="pl-c1">join</span>(<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>)};<span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_text2</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span>[],c<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;c<span class="pl-k">++</span>)<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">!==</span>a[c][<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span>(b[c]<span class="pl-k">=</span>a[c][<span class="pl-c1">1</span>]);<span class="pl-k">return</span> b.<span class="pl-c1">join</span>(<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>)};<span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_levenshtein</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span><span class="pl-c1">0</span>,c<span class="pl-k">=</span><span class="pl-c1">0</span>,d<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span><span class="pl-c1">0</span>;e<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;e<span class="pl-k">++</span>){<span class="pl-k">var</span> f<span class="pl-k">=</span>a[e][<span class="pl-c1">0</span>],g<span class="pl-k">=</span>a[e][<span class="pl-c1">1</span>];<span class="pl-k">switch</span>(f){<span class="pl-k">case</span> <span class="pl-c1">1</span><span class="pl-k">:</span>c<span class="pl-k">+=</span>g.<span class="pl-c1">length</span>;<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">:</span>d<span class="pl-k">+=</span>g.<span class="pl-c1">length</span>;<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-c1">0</span><span class="pl-k">:</span>b<span class="pl-k">+=</span><span class="pl-c1">Math</span>.<span class="pl-c1">max</span>(c,d),d<span class="pl-k">=</span>c<span class="pl-k">=</span><span class="pl-c1">0</span>}}<span class="pl-k">return</span> b<span class="pl-k">+=</span><span class="pl-c1">Math</span>.<span class="pl-c1">max</span>(c,d)};</td>
      </tr>
      <tr>
        <td id="L27" class="blob-num js-line-number" data-line-number="27"></td>
        <td id="LC27" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_toDelta</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span>[],c<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;c<span class="pl-k">++</span>)<span class="pl-k">switch</span>(a[c][<span class="pl-c1">0</span>]){<span class="pl-k">case</span> <span class="pl-c1">1</span><span class="pl-k">:</span>b[c]<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span>+<span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>encodeURI(a[c][<span class="pl-c1">1</span>]);<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">:</span>b[c]<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span>-<span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>a[c][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>;<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-c1">0</span><span class="pl-k">:</span>b[c]<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span>=<span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>a[c][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>}<span class="pl-k">return</span> b.<span class="pl-c1">join</span>(<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\t</span><span class="pl-pds">&quot;</span></span>).<span class="pl-c1">replace</span>(<span class="pl-sr"><span class="pl-pds">/</span>%20<span class="pl-pds">/</span>g</span>,<span class="pl-s"><span class="pl-pds">&quot;</span> <span class="pl-pds">&quot;</span></span>)};</td>
      </tr>
      <tr>
        <td id="L28" class="blob-num js-line-number" data-line-number="28"></td>
        <td id="LC28" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">diff_fromDelta</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> c<span class="pl-k">=</span>[],d<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span><span class="pl-c1">0</span>,f<span class="pl-k">=</span>b.<span class="pl-c1">split</span>(<span class="pl-sr"><span class="pl-pds">/</span><span class="pl-cce">\t</span><span class="pl-pds">/</span>g</span>),g<span class="pl-k">=</span><span class="pl-c1">0</span>;g<span class="pl-k">&lt;</span>f.<span class="pl-c1">length</span>;g<span class="pl-k">++</span>){<span class="pl-k">var</span> h<span class="pl-k">=</span>f[g].<span class="pl-c1">substring</span>(<span class="pl-c1">1</span>);<span class="pl-k">switch</span>(f[g].<span class="pl-c1">charAt</span>(<span class="pl-c1">0</span>)){<span class="pl-k">case</span> <span class="pl-s"><span class="pl-pds">&quot;</span>+<span class="pl-pds">&quot;</span></span><span class="pl-k">:</span><span class="pl-k">try</span>{c[d<span class="pl-k">++</span>]<span class="pl-k">=</span>[<span class="pl-c1">1</span>,decodeURI(h)]}<span class="pl-k">catch</span>(j){<span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&quot;</span>Illegal escape in diff_fromDelta: <span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>h);}<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-s"><span class="pl-pds">&quot;</span>-<span class="pl-pds">&quot;</span></span><span class="pl-k">:</span><span class="pl-k">case</span> <span class="pl-s"><span class="pl-pds">&quot;</span>=<span class="pl-pds">&quot;</span></span><span class="pl-k">:</span><span class="pl-k">var</span> i<span class="pl-k">=</span><span class="pl-c1">parseInt</span>(h,<span class="pl-c1">10</span>);<span class="pl-k">if</span>(<span class="pl-c1">isNaN</span>(i)<span class="pl-k">||</span><span class="pl-c1">0</span><span class="pl-k">&gt;</span>i)<span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&quot;</span>Invalid number in diff_fromDelta: <span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>h);h<span class="pl-k">=</span>a.<span class="pl-c1">substring</span>(e,e<span class="pl-k">+=</span>i);<span class="pl-s"><span class="pl-pds">&quot;</span>=<span class="pl-pds">&quot;</span></span><span class="pl-k">==</span>f[g].<span class="pl-c1">charAt</span>(<span class="pl-c1">0</span>)<span class="pl-k">?</span>c[d<span class="pl-k">++</span>]<span class="pl-k">=</span>[<span class="pl-c1">0</span>,h]<span class="pl-k">:</span>c[d<span class="pl-k">++</span>]<span class="pl-k">=</span>[<span class="pl-k">-</span><span class="pl-c1">1</span>,h];<span class="pl-k">break</span>;<span class="pl-k">default</span><span class="pl-k">:</span><span class="pl-k">if</span>(f[g])<span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&quot;</span>Invalid diff operation in diff_fromDelta: <span class="pl-pds">&quot;</span></span><span class="pl-k">+</span></td>
      </tr>
      <tr>
        <td id="L29" class="blob-num js-line-number" data-line-number="29"></td>
        <td id="LC29" class="blob-code blob-code-inner js-file-line">  f[g]);}}<span class="pl-k">if</span>(e<span class="pl-k">!=</span>a.<span class="pl-c1">length</span>)<span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&quot;</span>Delta length (<span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>e<span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span>) does not equal source text length (<span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>a.<span class="pl-c1">length</span><span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span>).<span class="pl-pds">&quot;</span></span>);<span class="pl-k">return</span> c};<span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">match_main</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>,<span class="pl-smi">c</span>){<span class="pl-k">if</span>(<span class="pl-c1">null</span><span class="pl-k">==</span>a<span class="pl-k">||</span><span class="pl-c1">null</span><span class="pl-k">==</span>b<span class="pl-k">||</span><span class="pl-c1">null</span><span class="pl-k">==</span>c)<span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&quot;</span>Null input. (match_main)<span class="pl-pds">&quot;</span></span>);c<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">max</span>(<span class="pl-c1">0</span>,<span class="pl-c1">Math</span>.<span class="pl-c1">min</span>(c,a.<span class="pl-c1">length</span>));<span class="pl-k">return</span> a<span class="pl-k">==</span>b<span class="pl-k">?</span><span class="pl-c1">0</span><span class="pl-k">:</span>a.<span class="pl-c1">length</span><span class="pl-k">?</span>a.<span class="pl-c1">substring</span>(c,c<span class="pl-k">+</span>b.<span class="pl-c1">length</span>)<span class="pl-k">==</span>b<span class="pl-k">?</span>c<span class="pl-k">:</span><span class="pl-v">this</span>.match_bitap_(a,b,c)<span class="pl-k">:-</span><span class="pl-c1">1</span>};</td>
      </tr>
      <tr>
        <td id="L30" class="blob-num js-line-number" data-line-number="30"></td>
        <td id="LC30" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">match_bitap_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>,<span class="pl-smi">c</span>){<span class="pl-k">function</span> <span class="pl-en">d</span>(<span class="pl-smi">a</span>,<span class="pl-smi">d</span>){<span class="pl-k">var</span> e<span class="pl-k">=</span>a<span class="pl-k">/</span>b.<span class="pl-c1">length</span>,g<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">abs</span>(c<span class="pl-k">-</span>d);<span class="pl-k">return</span><span class="pl-k">!</span>f.Match_Distance<span class="pl-k">?</span>g<span class="pl-k">?</span><span class="pl-c1">1</span><span class="pl-k">:</span>e<span class="pl-k">:</span>e<span class="pl-k">+</span>g<span class="pl-k">/</span>f.Match_Distance}<span class="pl-k">if</span>(b.<span class="pl-c1">length</span><span class="pl-k">&gt;</span><span class="pl-v">this</span>.Match_MaxBits)<span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&quot;</span>Pattern too long for this browser.<span class="pl-pds">&quot;</span></span>);<span class="pl-k">var</span> e<span class="pl-k">=</span><span class="pl-v">this</span>.match_alphabet_(b),f<span class="pl-k">=</span><span class="pl-v">this</span>,g<span class="pl-k">=</span><span class="pl-v">this</span>.Match_Threshold,h<span class="pl-k">=</span>a.<span class="pl-c1">indexOf</span>(b,c);<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">!=</span>h<span class="pl-k">&amp;&amp;</span>(g<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">min</span>(d(<span class="pl-c1">0</span>,h),g),h<span class="pl-k">=</span>a.<span class="pl-c1">lastIndexOf</span>(b,c<span class="pl-k">+</span>b.<span class="pl-c1">length</span>),<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">!=</span>h<span class="pl-k">&amp;&amp;</span>(g<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">min</span>(d(<span class="pl-c1">0</span>,h),g)));<span class="pl-k">for</span>(<span class="pl-k">var</span> j<span class="pl-k">=</span><span class="pl-c1">1</span><span class="pl-k">&lt;&lt;</span>b.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>,h<span class="pl-k">=-</span><span class="pl-c1">1</span>,i,k,q<span class="pl-k">=</span>b.<span class="pl-c1">length</span><span class="pl-k">+</span>a.<span class="pl-c1">length</span>,r,t<span class="pl-k">=</span><span class="pl-c1">0</span>;t<span class="pl-k">&lt;</span>b.<span class="pl-c1">length</span>;t<span class="pl-k">++</span>){i<span class="pl-k">=</span><span class="pl-c1">0</span>;<span class="pl-k">for</span>(k<span class="pl-k">=</span>q;i<span class="pl-k">&lt;</span>k;)d(t,c<span class="pl-k">+</span></td>
      </tr>
      <tr>
        <td id="L31" class="blob-num js-line-number" data-line-number="31"></td>
        <td id="LC31" class="blob-code blob-code-inner js-file-line">  k)<span class="pl-k">&lt;=</span>g<span class="pl-k">?</span>i<span class="pl-k">=</span>k<span class="pl-k">:</span>q<span class="pl-k">=</span>k,k<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">floor</span>((q<span class="pl-k">-</span>i)<span class="pl-k">/</span><span class="pl-c1">2</span><span class="pl-k">+</span>i);q<span class="pl-k">=</span>k;i<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">max</span>(<span class="pl-c1">1</span>,c<span class="pl-k">-</span>k<span class="pl-k">+</span><span class="pl-c1">1</span>);<span class="pl-k">var</span> p<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">min</span>(c<span class="pl-k">+</span>k,a.<span class="pl-c1">length</span>)<span class="pl-k">+</span>b.<span class="pl-c1">length</span>;k<span class="pl-k">=</span><span class="pl-c1">Array</span>(p<span class="pl-k">+</span><span class="pl-c1">2</span>);<span class="pl-k">for</span>(k[p<span class="pl-k">+</span><span class="pl-c1">1</span>]<span class="pl-k">=</span>(<span class="pl-c1">1</span><span class="pl-k">&lt;&lt;</span>t)<span class="pl-k">-</span><span class="pl-c1">1</span>;p<span class="pl-k">&gt;=</span>i;p<span class="pl-k">--</span>){<span class="pl-k">var</span> w<span class="pl-k">=</span>e[a.<span class="pl-c1">charAt</span>(p<span class="pl-k">-</span><span class="pl-c1">1</span>)];k[p]<span class="pl-k">=</span><span class="pl-c1">0</span><span class="pl-k">===</span>t<span class="pl-k">?</span>(k[p<span class="pl-k">+</span><span class="pl-c1">1</span>]<span class="pl-k">&lt;&lt;</span><span class="pl-c1">1</span>|<span class="pl-c1">1</span>)<span class="pl-k">&amp;</span>w<span class="pl-k">:</span>(k[p<span class="pl-k">+</span><span class="pl-c1">1</span>]<span class="pl-k">&lt;&lt;</span><span class="pl-c1">1</span>|<span class="pl-c1">1</span>)<span class="pl-k">&amp;</span>w|((r[p<span class="pl-k">+</span><span class="pl-c1">1</span>]|r[p])<span class="pl-k">&lt;&lt;</span><span class="pl-c1">1</span>|<span class="pl-c1">1</span>)|r[p<span class="pl-k">+</span><span class="pl-c1">1</span>];<span class="pl-k">if</span>(k[p]<span class="pl-k">&amp;</span>j<span class="pl-k">&amp;&amp;</span>(w<span class="pl-k">=</span>d(t,p<span class="pl-k">-</span><span class="pl-c1">1</span>),w<span class="pl-k">&lt;=</span>g))<span class="pl-k">if</span>(g<span class="pl-k">=</span>w,h<span class="pl-k">=</span>p<span class="pl-k">-</span><span class="pl-c1">1</span>,h<span class="pl-k">&gt;</span>c)i<span class="pl-k">=</span><span class="pl-c1">Math</span>.<span class="pl-c1">max</span>(<span class="pl-c1">1</span>,<span class="pl-c1">2</span><span class="pl-k">*</span>c<span class="pl-k">-</span>h);<span class="pl-k">else</span> <span class="pl-k">break</span>}<span class="pl-k">if</span>(d(t<span class="pl-k">+</span><span class="pl-c1">1</span>,c)<span class="pl-k">&gt;</span>g)<span class="pl-k">break</span>;r<span class="pl-k">=</span>k}<span class="pl-k">return</span> h};</td>
      </tr>
      <tr>
        <td id="L32" class="blob-num js-line-number" data-line-number="32"></td>
        <td id="LC32" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">match_alphabet_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span>{},c<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;c<span class="pl-k">++</span>)b[a.<span class="pl-c1">charAt</span>(c)]<span class="pl-k">=</span><span class="pl-c1">0</span>;<span class="pl-k">for</span>(c<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;c<span class="pl-k">++</span>)b[a.<span class="pl-c1">charAt</span>(c)]|<span class="pl-k">=</span><span class="pl-c1">1</span><span class="pl-k">&lt;&lt;</span>a.<span class="pl-c1">length</span><span class="pl-k">-</span>c<span class="pl-k">-</span><span class="pl-c1">1</span>;<span class="pl-k">return</span> b};</td>
      </tr>
      <tr>
        <td id="L33" class="blob-num js-line-number" data-line-number="33"></td>
        <td id="LC33" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">patch_addContext_</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">if</span>(<span class="pl-c1">0</span><span class="pl-k">!=</span>b.<span class="pl-c1">length</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> c<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(a.start2,a.start2<span class="pl-k">+</span>a.length1),d<span class="pl-k">=</span><span class="pl-c1">0</span>;b.<span class="pl-c1">indexOf</span>(c)<span class="pl-k">!=</span>b.<span class="pl-c1">lastIndexOf</span>(c)<span class="pl-k">&amp;&amp;</span>c.<span class="pl-c1">length</span><span class="pl-k">&lt;</span><span class="pl-v">this</span>.Match_MaxBits<span class="pl-k">-</span><span class="pl-v">this</span>.Patch_Margin<span class="pl-k">-</span><span class="pl-v">this</span>.Patch_Margin;)d<span class="pl-k">+=</span><span class="pl-v">this</span>.Patch_Margin,c<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(a.start2<span class="pl-k">-</span>d,a.start2<span class="pl-k">+</span>a.length1<span class="pl-k">+</span>d);d<span class="pl-k">+=</span><span class="pl-v">this</span>.Patch_Margin;(c<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(a.start2<span class="pl-k">-</span>d,a.start2))<span class="pl-k">&amp;&amp;</span>a.diffs.<span class="pl-c1">unshift</span>([<span class="pl-c1">0</span>,c]);(d<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(a.start2<span class="pl-k">+</span>a.length1,a.start2<span class="pl-k">+</span>a.length1<span class="pl-k">+</span>d))<span class="pl-k">&amp;&amp;</span>a.diffs.<span class="pl-c1">push</span>([<span class="pl-c1">0</span>,d]);a.start1<span class="pl-k">-=</span>c.<span class="pl-c1">length</span>;a.start2<span class="pl-k">-=</span>c.<span class="pl-c1">length</span>;a.length1<span class="pl-k">+=</span></td>
      </tr>
      <tr>
        <td id="L34" class="blob-num js-line-number" data-line-number="34"></td>
        <td id="LC34" class="blob-code blob-code-inner js-file-line">    c.<span class="pl-c1">length</span><span class="pl-k">+</span>d.<span class="pl-c1">length</span>;a.length2<span class="pl-k">+=</span>c.<span class="pl-c1">length</span><span class="pl-k">+</span>d.<span class="pl-c1">length</span>}};</td>
      </tr>
      <tr>
        <td id="L35" class="blob-num js-line-number" data-line-number="35"></td>
        <td id="LC35" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">patch_make</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>,<span class="pl-smi">c</span>){<span class="pl-k">var</span> d;<span class="pl-k">if</span>(<span class="pl-s"><span class="pl-pds">&quot;</span>string<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> a<span class="pl-k">&amp;&amp;</span><span class="pl-s"><span class="pl-pds">&quot;</span>string<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> b<span class="pl-k">&amp;&amp;</span><span class="pl-s"><span class="pl-pds">&quot;</span>undefined<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> c)d<span class="pl-k">=</span>a,b<span class="pl-k">=</span><span class="pl-v">this</span>.diff_main(d,b,<span class="pl-k">!</span><span class="pl-c1">0</span>),<span class="pl-c1">2</span><span class="pl-k">&lt;</span>b.<span class="pl-c1">length</span><span class="pl-k">&amp;&amp;</span>(<span class="pl-v">this</span>.diff_cleanupSemantic(b),<span class="pl-v">this</span>.diff_cleanupEfficiency(b));<span class="pl-k">else</span> <span class="pl-k">if</span>(a<span class="pl-k">&amp;&amp;</span><span class="pl-s"><span class="pl-pds">&quot;</span>object<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> a<span class="pl-k">&amp;&amp;</span><span class="pl-s"><span class="pl-pds">&quot;</span>undefined<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> b<span class="pl-k">&amp;&amp;</span><span class="pl-s"><span class="pl-pds">&quot;</span>undefined<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> c)b<span class="pl-k">=</span>a,d<span class="pl-k">=</span><span class="pl-v">this</span>.diff_text1(b);<span class="pl-k">else</span> <span class="pl-k">if</span>(<span class="pl-s"><span class="pl-pds">&quot;</span>string<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> a<span class="pl-k">&amp;&amp;</span>b<span class="pl-k">&amp;&amp;</span><span class="pl-s"><span class="pl-pds">&quot;</span>object<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> b<span class="pl-k">&amp;&amp;</span><span class="pl-s"><span class="pl-pds">&quot;</span>undefined<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> c)d<span class="pl-k">=</span>a;<span class="pl-k">else</span> <span class="pl-k">if</span>(<span class="pl-s"><span class="pl-pds">&quot;</span>string<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> a<span class="pl-k">&amp;&amp;</span><span class="pl-s"><span class="pl-pds">&quot;</span>string<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> b<span class="pl-k">&amp;&amp;</span>c<span class="pl-k">&amp;&amp;</span><span class="pl-s"><span class="pl-pds">&quot;</span>object<span class="pl-pds">&quot;</span></span><span class="pl-k">==typeof</span> c)d<span class="pl-k">=</span>a,b<span class="pl-k">=</span>c;<span class="pl-k">else</span> <span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&quot;</span>Unknown call format to patch_make.<span class="pl-pds">&quot;</span></span>);</td>
      </tr>
      <tr>
        <td id="L36" class="blob-num js-line-number" data-line-number="36"></td>
        <td id="LC36" class="blob-code blob-code-inner js-file-line">    <span class="pl-k">if</span>(<span class="pl-c1">0</span><span class="pl-k">===</span>b.<span class="pl-c1">length</span>)<span class="pl-k">return</span>[];c<span class="pl-k">=</span>[];a<span class="pl-k">=</span><span class="pl-k">new</span> <span class="pl-en">diff_match_patch.patch_obj</span>;<span class="pl-k">for</span>(<span class="pl-k">var</span> e<span class="pl-k">=</span><span class="pl-c1">0</span>,f<span class="pl-k">=</span><span class="pl-c1">0</span>,g<span class="pl-k">=</span><span class="pl-c1">0</span>,h<span class="pl-k">=</span>d,j<span class="pl-k">=</span><span class="pl-c1">0</span>;j<span class="pl-k">&lt;</span>b.<span class="pl-c1">length</span>;j<span class="pl-k">++</span>){<span class="pl-k">var</span> i<span class="pl-k">=</span>b[j][<span class="pl-c1">0</span>],k<span class="pl-k">=</span>b[j][<span class="pl-c1">1</span>];<span class="pl-k">!</span>e<span class="pl-k">&amp;&amp;</span><span class="pl-c1">0</span><span class="pl-k">!==</span>i<span class="pl-k">&amp;&amp;</span>(a.start1<span class="pl-k">=</span>f,a.start2<span class="pl-k">=</span>g);<span class="pl-k">switch</span>(i){<span class="pl-k">case</span> <span class="pl-c1">1</span><span class="pl-k">:</span>a.diffs[e<span class="pl-k">++</span>]<span class="pl-k">=</span>b[j];a.length2<span class="pl-k">+=</span>k.<span class="pl-c1">length</span>;d<span class="pl-k">=</span>d.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,g)<span class="pl-k">+</span>k<span class="pl-k">+</span>d.<span class="pl-c1">substring</span>(g);<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">:</span>a.length1<span class="pl-k">+=</span>k.<span class="pl-c1">length</span>;a.diffs[e<span class="pl-k">++</span>]<span class="pl-k">=</span>b[j];d<span class="pl-k">=</span>d.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,g)<span class="pl-k">+</span>d.<span class="pl-c1">substring</span>(g<span class="pl-k">+</span>k.<span class="pl-c1">length</span>);<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-c1">0</span><span class="pl-k">:</span>k.<span class="pl-c1">length</span><span class="pl-k">&lt;=</span><span class="pl-c1">2</span><span class="pl-k">*</span><span class="pl-v">this</span>.Patch_Margin<span class="pl-k">&amp;&amp;</span>e<span class="pl-k">&amp;&amp;</span>b.<span class="pl-c1">length</span><span class="pl-k">!=</span>j<span class="pl-k">+</span><span class="pl-c1">1</span><span class="pl-k">?</span>(a.diffs[e<span class="pl-k">++</span>]<span class="pl-k">=</span>b[j],a.length1<span class="pl-k">+=</span>k.<span class="pl-c1">length</span>,a.length2<span class="pl-k">+=</span>k.<span class="pl-c1">length</span>)<span class="pl-k">:</span>k.<span class="pl-c1">length</span><span class="pl-k">&gt;=</span><span class="pl-c1">2</span><span class="pl-k">*</span><span class="pl-v">this</span>.Patch_Margin<span class="pl-k">&amp;&amp;</span></td>
      </tr>
      <tr>
        <td id="L37" class="blob-num js-line-number" data-line-number="37"></td>
        <td id="LC37" class="blob-code blob-code-inner js-file-line">    e<span class="pl-k">&amp;&amp;</span>(<span class="pl-v">this</span>.patch_addContext_(a,h),c.<span class="pl-c1">push</span>(a),a<span class="pl-k">=</span><span class="pl-k">new</span> <span class="pl-en">diff_match_patch.patch_obj</span>,e<span class="pl-k">=</span><span class="pl-c1">0</span>,h<span class="pl-k">=</span>d,f<span class="pl-k">=</span>g)}<span class="pl-c1">1</span><span class="pl-k">!==</span>i<span class="pl-k">&amp;&amp;</span>(f<span class="pl-k">+=</span>k.<span class="pl-c1">length</span>);<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">!==</span>i<span class="pl-k">&amp;&amp;</span>(g<span class="pl-k">+=</span>k.<span class="pl-c1">length</span>)}e<span class="pl-k">&amp;&amp;</span>(<span class="pl-v">this</span>.patch_addContext_(a,h),c.<span class="pl-c1">push</span>(a));<span class="pl-k">return</span> c};<span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">patch_deepCopy</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span>[],c<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;c<span class="pl-k">++</span>){<span class="pl-k">var</span> d<span class="pl-k">=</span>a[c],e<span class="pl-k">=</span><span class="pl-k">new</span> <span class="pl-en">diff_match_patch.patch_obj</span>;e.diffs<span class="pl-k">=</span>[];<span class="pl-k">for</span>(<span class="pl-k">var</span> f<span class="pl-k">=</span><span class="pl-c1">0</span>;f<span class="pl-k">&lt;</span>d.diffs.<span class="pl-c1">length</span>;f<span class="pl-k">++</span>)e.diffs[f]<span class="pl-k">=</span>d.diffs[f].<span class="pl-c1">slice</span>();e.start1<span class="pl-k">=</span>d.start1;e.start2<span class="pl-k">=</span>d.start2;e.length1<span class="pl-k">=</span>d.length1;e.length2<span class="pl-k">=</span>d.length2;b[c]<span class="pl-k">=</span>e}<span class="pl-k">return</span> b};</td>
      </tr>
      <tr>
        <td id="L38" class="blob-num js-line-number" data-line-number="38"></td>
        <td id="LC38" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">patch_apply</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>,<span class="pl-smi">b</span>){<span class="pl-k">if</span>(<span class="pl-c1">0</span><span class="pl-k">==</span>a.<span class="pl-c1">length</span>)<span class="pl-k">return</span>[b,[]];a<span class="pl-k">=</span><span class="pl-v">this</span>.patch_deepCopy(a);<span class="pl-k">var</span> c<span class="pl-k">=</span><span class="pl-v">this</span>.patch_addPadding(a);b<span class="pl-k">=</span>c<span class="pl-k">+</span>b<span class="pl-k">+</span>c;<span class="pl-v">this</span>.patch_splitMax(a);<span class="pl-k">for</span>(<span class="pl-k">var</span> d<span class="pl-k">=</span><span class="pl-c1">0</span>,e<span class="pl-k">=</span>[],f<span class="pl-k">=</span><span class="pl-c1">0</span>;f<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;f<span class="pl-k">++</span>){<span class="pl-k">var</span> g<span class="pl-k">=</span>a[f].start2<span class="pl-k">+</span>d,h<span class="pl-k">=</span><span class="pl-v">this</span>.diff_text1(a[f].diffs),j,i<span class="pl-k">=-</span><span class="pl-c1">1</span>;<span class="pl-k">if</span>(h.<span class="pl-c1">length</span><span class="pl-k">&gt;</span><span class="pl-v">this</span>.Match_MaxBits){<span class="pl-k">if</span>(j<span class="pl-k">=</span><span class="pl-v">this</span>.match_main(b,h.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,<span class="pl-v">this</span>.Match_MaxBits),g),<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">!=</span>j<span class="pl-k">&amp;&amp;</span>(i<span class="pl-k">=</span><span class="pl-v">this</span>.match_main(b,h.<span class="pl-c1">substring</span>(h.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-v">this</span>.Match_MaxBits),g<span class="pl-k">+</span>h.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-v">this</span>.Match_MaxBits),<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">==</span>i<span class="pl-k">||</span>j<span class="pl-k">&gt;=</span>i))j<span class="pl-k">=-</span><span class="pl-c1">1</span>}<span class="pl-k">else</span> j<span class="pl-k">=</span><span class="pl-v">this</span>.match_main(b,h,g);</td>
      </tr>
      <tr>
        <td id="L39" class="blob-num js-line-number" data-line-number="39"></td>
        <td id="LC39" class="blob-code blob-code-inner js-file-line">    <span class="pl-k">if</span>(<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">==</span>j)e[f]<span class="pl-k">=!</span><span class="pl-c1">1</span>,d<span class="pl-k">-=</span>a[f].length2<span class="pl-k">-</span>a[f].length1;<span class="pl-k">else</span> <span class="pl-k">if</span>(e[f]<span class="pl-k">=!</span><span class="pl-c1">0</span>,d<span class="pl-k">=</span>j<span class="pl-k">-</span>g,g<span class="pl-k">=-</span><span class="pl-c1">1</span><span class="pl-k">==</span>i<span class="pl-k">?</span>b.<span class="pl-c1">substring</span>(j,j<span class="pl-k">+</span>h.<span class="pl-c1">length</span>)<span class="pl-k">:</span>b.<span class="pl-c1">substring</span>(j,i<span class="pl-k">+</span><span class="pl-v">this</span>.Match_MaxBits),h<span class="pl-k">==</span>g)b<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,j)<span class="pl-k">+</span><span class="pl-v">this</span>.diff_text2(a[f].diffs)<span class="pl-k">+</span>b.<span class="pl-c1">substring</span>(j<span class="pl-k">+</span>h.<span class="pl-c1">length</span>);<span class="pl-k">else</span> <span class="pl-k">if</span>(g<span class="pl-k">=</span><span class="pl-v">this</span>.diff_main(h,g,<span class="pl-k">!</span><span class="pl-c1">1</span>),h.<span class="pl-c1">length</span><span class="pl-k">&gt;</span><span class="pl-v">this</span>.Match_MaxBits<span class="pl-k">&amp;&amp;</span><span class="pl-v">this</span>.diff_levenshtein(g)<span class="pl-k">/</span>h.<span class="pl-c1">length</span><span class="pl-k">&gt;</span><span class="pl-v">this</span>.Patch_DeleteThreshold)e[f]<span class="pl-k">=!</span><span class="pl-c1">1</span>;<span class="pl-k">else</span>{<span class="pl-v">this</span>.diff_cleanupSemanticLossless(g);<span class="pl-k">for</span>(<span class="pl-k">var</span> h<span class="pl-k">=</span><span class="pl-c1">0</span>,k,i<span class="pl-k">=</span><span class="pl-c1">0</span>;i<span class="pl-k">&lt;</span>a[f].diffs.<span class="pl-c1">length</span>;i<span class="pl-k">++</span>){<span class="pl-k">var</span> q<span class="pl-k">=</span>a[f].diffs[i];<span class="pl-c1">0</span><span class="pl-k">!==</span>q[<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span>(k<span class="pl-k">=</span><span class="pl-v">this</span>.diff_xIndex(g,h));<span class="pl-c1">1</span><span class="pl-k">===</span>q[<span class="pl-c1">0</span>]<span class="pl-k">?</span>b<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,</td>
      </tr>
      <tr>
        <td id="L40" class="blob-num js-line-number" data-line-number="40"></td>
        <td id="LC40" class="blob-code blob-code-inner js-file-line">      j<span class="pl-k">+</span>k)<span class="pl-k">+</span>q[<span class="pl-c1">1</span>]<span class="pl-k">+</span>b.<span class="pl-c1">substring</span>(j<span class="pl-k">+</span>k)<span class="pl-k">:-</span><span class="pl-c1">1</span><span class="pl-k">===</span>q[<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span>(b<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,j<span class="pl-k">+</span>k)<span class="pl-k">+</span>b.<span class="pl-c1">substring</span>(j<span class="pl-k">+</span><span class="pl-v">this</span>.diff_xIndex(g,h<span class="pl-k">+</span>q[<span class="pl-c1">1</span>].<span class="pl-c1">length</span>)));<span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">!==</span>q[<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span>(h<span class="pl-k">+=</span>q[<span class="pl-c1">1</span>].<span class="pl-c1">length</span>)}}}b<span class="pl-k">=</span>b.<span class="pl-c1">substring</span>(c.<span class="pl-c1">length</span>,b.<span class="pl-c1">length</span><span class="pl-k">-</span>c.<span class="pl-c1">length</span>);<span class="pl-k">return</span>[b,e]};</td>
      </tr>
      <tr>
        <td id="L41" class="blob-num js-line-number" data-line-number="41"></td>
        <td id="LC41" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">patch_addPadding</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span><span class="pl-v">this</span>.Patch_Margin,c<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>,d<span class="pl-k">=</span><span class="pl-c1">1</span>;d<span class="pl-k">&lt;=</span>b;d<span class="pl-k">++</span>)c<span class="pl-k">+=</span><span class="pl-c1">String</span>.<span class="pl-c1">fromCharCode</span>(d);<span class="pl-k">for</span>(d<span class="pl-k">=</span><span class="pl-c1">0</span>;d<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;d<span class="pl-k">++</span>)a[d].start1<span class="pl-k">+=</span>b,a[d].start2<span class="pl-k">+=</span>b;<span class="pl-k">var</span> d<span class="pl-k">=</span>a[<span class="pl-c1">0</span>],e<span class="pl-k">=</span>d.diffs;<span class="pl-k">if</span>(<span class="pl-c1">0</span><span class="pl-k">==</span>e.<span class="pl-c1">length</span><span class="pl-k">||</span><span class="pl-c1">0</span><span class="pl-k">!=</span>e[<span class="pl-c1">0</span>][<span class="pl-c1">0</span>])e.<span class="pl-c1">unshift</span>([<span class="pl-c1">0</span>,c]),d.start1<span class="pl-k">-=</span>b,d.start2<span class="pl-k">-=</span>b,d.length1<span class="pl-k">+=</span>b,d.length2<span class="pl-k">+=</span>b;<span class="pl-k">else</span> <span class="pl-k">if</span>(b<span class="pl-k">&gt;</span>e[<span class="pl-c1">0</span>][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>){<span class="pl-k">var</span> f<span class="pl-k">=</span>b<span class="pl-k">-</span>e[<span class="pl-c1">0</span>][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>;e[<span class="pl-c1">0</span>][<span class="pl-c1">1</span>]<span class="pl-k">=</span>c.<span class="pl-c1">substring</span>(e[<span class="pl-c1">0</span>][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>)<span class="pl-k">+</span>e[<span class="pl-c1">0</span>][<span class="pl-c1">1</span>];d.start1<span class="pl-k">-=</span>f;d.start2<span class="pl-k">-=</span>f;d.length1<span class="pl-k">+=</span>f;d.length2<span class="pl-k">+=</span>f}d<span class="pl-k">=</span>a[a.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>];e<span class="pl-k">=</span>d.diffs;<span class="pl-c1">0</span><span class="pl-k">==</span>e.<span class="pl-c1">length</span><span class="pl-k">||</span><span class="pl-c1">0</span><span class="pl-k">!=</span>e[e.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">?</span>(e.<span class="pl-c1">push</span>([<span class="pl-c1">0</span>,</td>
      </tr>
      <tr>
        <td id="L42" class="blob-num js-line-number" data-line-number="42"></td>
        <td id="LC42" class="blob-code blob-code-inner js-file-line">    c]),d.length1<span class="pl-k">+=</span>b,d.length2<span class="pl-k">+=</span>b)<span class="pl-k">:</span>b<span class="pl-k">&gt;</span>e[e.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>].<span class="pl-c1">length</span><span class="pl-k">&amp;&amp;</span>(f<span class="pl-k">=</span>b<span class="pl-k">-</span>e[e.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>].<span class="pl-c1">length</span>,e[e.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">+=</span>c.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,f),d.length1<span class="pl-k">+=</span>f,d.length2<span class="pl-k">+=</span>f);<span class="pl-k">return</span> c};</td>
      </tr>
      <tr>
        <td id="L43" class="blob-num js-line-number" data-line-number="43"></td>
        <td id="LC43" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">patch_splitMax</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span><span class="pl-v">this</span>.Match_MaxBits,c<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;c<span class="pl-k">++</span>)<span class="pl-k">if</span>(<span class="pl-k">!</span>(a[c].length1<span class="pl-k">&lt;=</span>b)){<span class="pl-k">var</span> d<span class="pl-k">=</span>a[c];a.<span class="pl-c1">splice</span>(c<span class="pl-k">--</span>,<span class="pl-c1">1</span>);<span class="pl-k">for</span>(<span class="pl-k">var</span> e<span class="pl-k">=</span>d.start1,f<span class="pl-k">=</span>d.start2,g<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>;<span class="pl-c1">0</span><span class="pl-k">!==</span>d.diffs.<span class="pl-c1">length</span>;){<span class="pl-k">var</span> h<span class="pl-k">=</span><span class="pl-k">new</span> <span class="pl-en">diff_match_patch.patch_obj</span>,j<span class="pl-k">=!</span><span class="pl-c1">0</span>;h.start1<span class="pl-k">=</span>e<span class="pl-k">-</span>g.<span class="pl-c1">length</span>;h.start2<span class="pl-k">=</span>f<span class="pl-k">-</span>g.<span class="pl-c1">length</span>;<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span><span class="pl-k">!==</span>g<span class="pl-k">&amp;&amp;</span>(h.length1<span class="pl-k">=</span>h.length2<span class="pl-k">=</span>g.<span class="pl-c1">length</span>,h.diffs.<span class="pl-c1">push</span>([<span class="pl-c1">0</span>,g]));<span class="pl-k">for</span>(;<span class="pl-c1">0</span><span class="pl-k">!==</span>d.diffs.<span class="pl-c1">length</span><span class="pl-k">&amp;&amp;</span>h.length1<span class="pl-k">&lt;</span>b<span class="pl-k">-</span><span class="pl-v">this</span>.Patch_Margin;){<span class="pl-k">var</span> g<span class="pl-k">=</span>d.diffs[<span class="pl-c1">0</span>][<span class="pl-c1">0</span>],i<span class="pl-k">=</span>d.diffs[<span class="pl-c1">0</span>][<span class="pl-c1">1</span>];<span class="pl-c1">1</span><span class="pl-k">===</span>g<span class="pl-k">?</span>(h.length2<span class="pl-k">+=</span>i.<span class="pl-c1">length</span>,f<span class="pl-k">+=</span>i.<span class="pl-c1">length</span>,h.diffs.<span class="pl-c1">push</span>(d.diffs.<span class="pl-c1">shift</span>()),</td>
      </tr>
      <tr>
        <td id="L44" class="blob-num js-line-number" data-line-number="44"></td>
        <td id="LC44" class="blob-code blob-code-inner js-file-line">    j<span class="pl-k">=!</span><span class="pl-c1">1</span>)<span class="pl-k">:-</span><span class="pl-c1">1</span><span class="pl-k">===</span>g<span class="pl-k">&amp;&amp;</span><span class="pl-c1">1</span><span class="pl-k">==</span>h.diffs.<span class="pl-c1">length</span><span class="pl-k">&amp;&amp;</span><span class="pl-c1">0</span><span class="pl-k">==</span>h.diffs[<span class="pl-c1">0</span>][<span class="pl-c1">0</span>]<span class="pl-k">&amp;&amp;</span>i.<span class="pl-c1">length</span><span class="pl-k">&gt;</span><span class="pl-c1">2</span><span class="pl-k">*</span>b<span class="pl-k">?</span>(h.length1<span class="pl-k">+=</span>i.<span class="pl-c1">length</span>,e<span class="pl-k">+=</span>i.<span class="pl-c1">length</span>,j<span class="pl-k">=!</span><span class="pl-c1">1</span>,h.diffs.<span class="pl-c1">push</span>([g,i]),d.diffs.<span class="pl-c1">shift</span>())<span class="pl-k">:</span>(i<span class="pl-k">=</span>i.<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,b<span class="pl-k">-</span>h.length1<span class="pl-k">-</span><span class="pl-v">this</span>.Patch_Margin),h.length1<span class="pl-k">+=</span>i.<span class="pl-c1">length</span>,e<span class="pl-k">+=</span>i.<span class="pl-c1">length</span>,<span class="pl-c1">0</span><span class="pl-k">===</span>g<span class="pl-k">?</span>(h.length2<span class="pl-k">+=</span>i.<span class="pl-c1">length</span>,f<span class="pl-k">+=</span>i.<span class="pl-c1">length</span>)<span class="pl-k">:</span>j<span class="pl-k">=!</span><span class="pl-c1">1</span>,h.diffs.<span class="pl-c1">push</span>([g,i]),i<span class="pl-k">==</span>d.diffs[<span class="pl-c1">0</span>][<span class="pl-c1">1</span>]<span class="pl-k">?</span>d.diffs.<span class="pl-c1">shift</span>()<span class="pl-k">:</span>d.diffs[<span class="pl-c1">0</span>][<span class="pl-c1">1</span>]<span class="pl-k">=</span>d.diffs[<span class="pl-c1">0</span>][<span class="pl-c1">1</span>].<span class="pl-c1">substring</span>(i.<span class="pl-c1">length</span>))}g<span class="pl-k">=</span><span class="pl-v">this</span>.diff_text2(h.diffs);g<span class="pl-k">=</span>g.<span class="pl-c1">substring</span>(g.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-v">this</span>.Patch_Margin);i<span class="pl-k">=</span><span class="pl-v">this</span>.diff_text1(d.diffs).<span class="pl-c1">substring</span>(<span class="pl-c1">0</span>,<span class="pl-v">this</span>.Patch_Margin);<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span><span class="pl-k">!==</span>i<span class="pl-k">&amp;&amp;</span></td>
      </tr>
      <tr>
        <td id="L45" class="blob-num js-line-number" data-line-number="45"></td>
        <td id="LC45" class="blob-code blob-code-inner js-file-line">  (h.length1<span class="pl-k">+=</span>i.<span class="pl-c1">length</span>,h.length2<span class="pl-k">+=</span>i.<span class="pl-c1">length</span>,<span class="pl-c1">0</span><span class="pl-k">!==</span>h.diffs.<span class="pl-c1">length</span><span class="pl-k">&amp;&amp;</span><span class="pl-c1">0</span><span class="pl-k">===</span>h.diffs[h.diffs.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">0</span>]<span class="pl-k">?</span>h.diffs[h.diffs.<span class="pl-c1">length</span><span class="pl-k">-</span><span class="pl-c1">1</span>][<span class="pl-c1">1</span>]<span class="pl-k">+=</span>i<span class="pl-k">:</span>h.diffs.<span class="pl-c1">push</span>([<span class="pl-c1">0</span>,i]));j<span class="pl-k">||</span>a.<span class="pl-c1">splice</span>(<span class="pl-k">++</span>c,<span class="pl-c1">0</span>,h)}}};<span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">patch_toText</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">for</span>(<span class="pl-k">var</span> b<span class="pl-k">=</span>[],c<span class="pl-k">=</span><span class="pl-c1">0</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;c<span class="pl-k">++</span>)b[c]<span class="pl-k">=</span>a[c];<span class="pl-k">return</span> b.<span class="pl-c1">join</span>(<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>)};</td>
      </tr>
      <tr>
        <td id="L46" class="blob-num js-line-number" data-line-number="46"></td>
        <td id="LC46" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">patch_fromText</span><span class="pl-k">=</span><span class="pl-k">function</span>(<span class="pl-smi">a</span>){<span class="pl-k">var</span> b<span class="pl-k">=</span>[];<span class="pl-k">if</span>(<span class="pl-k">!</span>a)<span class="pl-k">return</span> b;a<span class="pl-k">=</span>a.<span class="pl-c1">split</span>(<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>);<span class="pl-k">for</span>(<span class="pl-k">var</span> c<span class="pl-k">=</span><span class="pl-c1">0</span>,d<span class="pl-k">=</span><span class="pl-sr"><span class="pl-pds">/</span><span class="pl-k">^</span>@@ -(<span class="pl-c1">\d</span><span class="pl-k">+</span>),<span class="pl-k">?</span>(<span class="pl-c1">\d</span><span class="pl-k">*</span>) <span class="pl-cce">\+</span>(<span class="pl-c1">\d</span><span class="pl-k">+</span>),<span class="pl-k">?</span>(<span class="pl-c1">\d</span><span class="pl-k">*</span>) @@<span class="pl-k">$</span><span class="pl-pds">/</span></span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;){<span class="pl-k">var</span> e<span class="pl-k">=</span>a[c].<span class="pl-c1">match</span>(d);<span class="pl-k">if</span>(<span class="pl-k">!</span>e)<span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&quot;</span>Invalid patch string: <span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>a[c]);<span class="pl-k">var</span> f<span class="pl-k">=</span><span class="pl-k">new</span> <span class="pl-en">diff_match_patch.patch_obj</span>;b.<span class="pl-c1">push</span>(f);f.start1<span class="pl-k">=</span><span class="pl-c1">parseInt</span>(e[<span class="pl-c1">1</span>],<span class="pl-c1">10</span>);<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span><span class="pl-k">===</span>e[<span class="pl-c1">2</span>]<span class="pl-k">?</span>(f.start1<span class="pl-k">--</span>,f.length1<span class="pl-k">=</span><span class="pl-c1">1</span>)<span class="pl-k">:</span><span class="pl-s"><span class="pl-pds">&quot;</span>0<span class="pl-pds">&quot;</span></span><span class="pl-k">==</span>e[<span class="pl-c1">2</span>]<span class="pl-k">?</span>f.length1<span class="pl-k">=</span><span class="pl-c1">0</span><span class="pl-k">:</span>(f.start1<span class="pl-k">--</span>,f.length1<span class="pl-k">=</span><span class="pl-c1">parseInt</span>(e[<span class="pl-c1">2</span>],<span class="pl-c1">10</span>));f.start2<span class="pl-k">=</span><span class="pl-c1">parseInt</span>(e[<span class="pl-c1">3</span>],<span class="pl-c1">10</span>);<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span><span class="pl-k">===</span>e[<span class="pl-c1">4</span>]<span class="pl-k">?</span>(f.start2<span class="pl-k">--</span>,f.length2<span class="pl-k">=</span><span class="pl-c1">1</span>)<span class="pl-k">:</span><span class="pl-s"><span class="pl-pds">&quot;</span>0<span class="pl-pds">&quot;</span></span><span class="pl-k">==</span>e[<span class="pl-c1">4</span>]<span class="pl-k">?</span>f.length2<span class="pl-k">=</span><span class="pl-c1">0</span><span class="pl-k">:</span>(f.start2<span class="pl-k">--</span>,f.length2<span class="pl-k">=</span></td>
      </tr>
      <tr>
        <td id="L47" class="blob-num js-line-number" data-line-number="47"></td>
        <td id="LC47" class="blob-code blob-code-inner js-file-line">    <span class="pl-c1">parseInt</span>(e[<span class="pl-c1">4</span>],<span class="pl-c1">10</span>));<span class="pl-k">for</span>(c<span class="pl-k">++</span>;c<span class="pl-k">&lt;</span>a.<span class="pl-c1">length</span>;){e<span class="pl-k">=</span>a[c].<span class="pl-c1">charAt</span>(<span class="pl-c1">0</span>);<span class="pl-k">try</span>{<span class="pl-k">var</span> g<span class="pl-k">=</span>decodeURI(a[c].<span class="pl-c1">substring</span>(<span class="pl-c1">1</span>))}<span class="pl-k">catch</span>(h){<span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&quot;</span>Illegal escape in patch_fromText: <span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>g);}<span class="pl-k">if</span>(<span class="pl-s"><span class="pl-pds">&quot;</span>-<span class="pl-pds">&quot;</span></span><span class="pl-k">==</span>e)f.diffs.<span class="pl-c1">push</span>([<span class="pl-k">-</span><span class="pl-c1">1</span>,g]);<span class="pl-k">else</span> <span class="pl-k">if</span>(<span class="pl-s"><span class="pl-pds">&quot;</span>+<span class="pl-pds">&quot;</span></span><span class="pl-k">==</span>e)f.diffs.<span class="pl-c1">push</span>([<span class="pl-c1">1</span>,g]);<span class="pl-k">else</span> <span class="pl-k">if</span>(<span class="pl-s"><span class="pl-pds">&quot;</span> <span class="pl-pds">&quot;</span></span><span class="pl-k">==</span>e)f.diffs.<span class="pl-c1">push</span>([<span class="pl-c1">0</span>,g]);<span class="pl-k">else</span> <span class="pl-k">if</span>(<span class="pl-s"><span class="pl-pds">&quot;</span>@<span class="pl-pds">&quot;</span></span><span class="pl-k">==</span>e)<span class="pl-k">break</span>;<span class="pl-k">else</span> <span class="pl-k">if</span>(<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span><span class="pl-k">!==</span>e)<span class="pl-k">throw</span> Error(<span class="pl-s"><span class="pl-pds">&#39;</span>Invalid patch mode &quot;<span class="pl-pds">&#39;</span></span><span class="pl-k">+</span>e<span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&#39;</span>&quot; in: <span class="pl-pds">&#39;</span></span><span class="pl-k">+</span>g);c<span class="pl-k">++</span>}}<span class="pl-k">return</span> b};<span class="pl-c1">diff_match_patch</span>.<span class="pl-en">patch_obj</span><span class="pl-k">=</span><span class="pl-k">function</span>(){<span class="pl-v">this</span>.diffs<span class="pl-k">=</span>[];<span class="pl-v">this</span>.start2<span class="pl-k">=</span><span class="pl-v">this</span>.start1<span class="pl-k">=</span><span class="pl-c1">null</span>;<span class="pl-v">this</span>.length2<span class="pl-k">=</span><span class="pl-v">this</span>.length1<span class="pl-k">=</span><span class="pl-c1">0</span>};</td>
      </tr>
      <tr>
        <td id="L48" class="blob-num js-line-number" data-line-number="48"></td>
        <td id="LC48" class="blob-code blob-code-inner js-file-line">  <span class="pl-c1">diff_match_patch.patch_obj</span>.<span class="pl-c1">prototype</span>.<span class="pl-en">toString</span><span class="pl-k">=</span><span class="pl-k">function</span>(){<span class="pl-k">var</span> a,b;a<span class="pl-k">=</span><span class="pl-c1">0</span><span class="pl-k">===</span><span class="pl-v">this</span>.length1<span class="pl-k">?</span><span class="pl-v">this</span>.start1<span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span>,0<span class="pl-pds">&quot;</span></span><span class="pl-k">:</span><span class="pl-c1">1</span><span class="pl-k">==</span><span class="pl-v">this</span>.length1<span class="pl-k">?</span><span class="pl-v">this</span>.start1<span class="pl-k">+</span><span class="pl-c1">1</span><span class="pl-k">:</span><span class="pl-v">this</span>.start1<span class="pl-k">+</span><span class="pl-c1">1</span><span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span>,<span class="pl-pds">&quot;</span></span><span class="pl-k">+</span><span class="pl-v">this</span>.length1;b<span class="pl-k">=</span><span class="pl-c1">0</span><span class="pl-k">===</span><span class="pl-v">this</span>.length2<span class="pl-k">?</span><span class="pl-v">this</span>.start2<span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span>,0<span class="pl-pds">&quot;</span></span><span class="pl-k">:</span><span class="pl-c1">1</span><span class="pl-k">==</span><span class="pl-v">this</span>.length2<span class="pl-k">?</span><span class="pl-v">this</span>.start2<span class="pl-k">+</span><span class="pl-c1">1</span><span class="pl-k">:</span><span class="pl-v">this</span>.start2<span class="pl-k">+</span><span class="pl-c1">1</span><span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span>,<span class="pl-pds">&quot;</span></span><span class="pl-k">+</span><span class="pl-v">this</span>.length2;a<span class="pl-k">=</span>[<span class="pl-s"><span class="pl-pds">&quot;</span>@@ -<span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>a<span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span> +<span class="pl-pds">&quot;</span></span><span class="pl-k">+</span>b<span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span> @@<span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>];<span class="pl-k">var</span> c;<span class="pl-k">for</span>(b<span class="pl-k">=</span><span class="pl-c1">0</span>;b<span class="pl-k">&lt;</span><span class="pl-v">this</span>.diffs.<span class="pl-c1">length</span>;b<span class="pl-k">++</span>){<span class="pl-k">switch</span>(<span class="pl-v">this</span>.diffs[b][<span class="pl-c1">0</span>]){<span class="pl-k">case</span> <span class="pl-c1">1</span><span class="pl-k">:</span>c<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span>+<span class="pl-pds">&quot;</span></span>;<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-k">-</span><span class="pl-c1">1</span><span class="pl-k">:</span>c<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span>-<span class="pl-pds">&quot;</span></span>;<span class="pl-k">break</span>;<span class="pl-k">case</span> <span class="pl-c1">0</span><span class="pl-k">:</span>c<span class="pl-k">=</span><span class="pl-s"><span class="pl-pds">&quot;</span> <span class="pl-pds">&quot;</span></span>}a[b<span class="pl-k">+</span><span class="pl-c1">1</span>]<span class="pl-k">=</span>c<span class="pl-k">+</span>encodeURI(<span class="pl-v">this</span>.diffs[b][<span class="pl-c1">1</span>])<span class="pl-k">+</span><span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-cce">\n</span><span class="pl-pds">&quot;</span></span>}<span class="pl-k">return</span> a.<span class="pl-c1">join</span>(<span class="pl-s"><span class="pl-pds">&quot;</span><span class="pl-pds">&quot;</span></span>).<span class="pl-c1">replace</span>(<span class="pl-sr"><span class="pl-pds">/</span>%20<span class="pl-pds">/</span>g</span>,<span class="pl-s"><span class="pl-pds">&quot;</span> <span class="pl-pds">&quot;</span></span>)};</td>
      </tr>
      <tr>
        <td id="L49" class="blob-num js-line-number" data-line-number="49"></td>
        <td id="LC49" class="blob-code blob-code-inner js-file-line">  <span class="pl-v">this</span>.diff_match_patch<span class="pl-k">=</span>diff_match_patch;<span class="pl-v">this</span>.DIFF_DELETE<span class="pl-k">=-</span><span class="pl-c1">1</span>;<span class="pl-v">this</span>.DIFF_INSERT<span class="pl-k">=</span><span class="pl-c1">1</span>;<span class="pl-v">this</span>.DIFF_EQUAL<span class="pl-k">=</span><span class="pl-c1">0</span>;})()</td>
      </tr>
</table>

  </div>

</div>

<a href="#jump-to-line" rel="facebox[.linejump]" data-hotkey="l" style="display:none">Jump to Line</a>
<div id="jump-to-line" style="display:none">
  <!-- </textarea> --><!-- '"` --><form accept-charset="UTF-8" action="" class="js-jump-to-line-form" method="get"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
    <input class="linejump-input js-jump-to-line-field" type="text" placeholder="Jump to line&hellip;" aria-label="Jump to line" autofocus>
    <button type="submit" class="btn">Go</button>
</form></div>

        </div>
      </div>
      <div class="modal-backdrop"></div>
    </div>
  </div>



      <div class="container">
  <div class="site-footer" role="contentinfo">
    <ul class="site-footer-links right">
        <li><a href="https://status.github.com/" data-ga-click="Footer, go to status, text:status">Status</a></li>
      <li><a href="https://developer.github.com" data-ga-click="Footer, go to api, text:api">API</a></li>
      <li><a href="https://training.github.com" data-ga-click="Footer, go to training, text:training">Training</a></li>
      <li><a href="https://shop.github.com" data-ga-click="Footer, go to shop, text:shop">Shop</a></li>
        <li><a href="https://github.com/blog" data-ga-click="Footer, go to blog, text:blog">Blog</a></li>
        <li><a href="https://github.com/about" data-ga-click="Footer, go to about, text:about">About</a></li>
        <li><a href="https://github.com/pricing" data-ga-click="Footer, go to pricing, text:pricing">Pricing</a></li>

    </ul>

    <a href="https://github.com" aria-label="Homepage">
      <span class="mega-octicon octicon-mark-github" title="GitHub"></span>
</a>
    <ul class="site-footer-links">
      <li>&copy; 2015 <span title="0.12595s from github-fe126-cp1-prd.iad.github.net">GitHub</span>, Inc.</li>
        <li><a href="https://github.com/site/terms" data-ga-click="Footer, go to terms, text:terms">Terms</a></li>
        <li><a href="https://github.com/site/privacy" data-ga-click="Footer, go to privacy, text:privacy">Privacy</a></li>
        <li><a href="https://github.com/security" data-ga-click="Footer, go to security, text:security">Security</a></li>
        <li><a href="https://github.com/contact" data-ga-click="Footer, go to contact, text:contact">Contact</a></li>
        <li><a href="https://help.github.com" data-ga-click="Footer, go to help, text:help">Help</a></li>
    </ul>
  </div>
</div>



    
    

    <div id="ajax-error-message" class="flash flash-error">
      <span class="octicon octicon-alert"></span>
      <button type="button" class="flash-close js-flash-close js-ajax-error-dismiss" aria-label="Dismiss error">
        <span class="octicon octicon-x"></span>
      </button>
      Something went wrong with that request. Please try again.
    </div>


      <script crossorigin="anonymous" src="https://assets-cdn.github.com/assets/frameworks-06e65f5639cc52d1aaada53115a54614b60fa90ab446a673e3e1818df167663b.js"></script>
      <script async="async" crossorigin="anonymous" src="https://assets-cdn.github.com/assets/github-435b0c380a8b91b3f42654ca3dbe8b623eebe6dfa2314a80f961d364de7e3f42.js"></script>
      
      
    <div class="js-stale-session-flash stale-session-flash flash flash-warn flash-banner hidden">
      <span class="octicon octicon-alert"></span>
      <span class="signed-in-tab-flash">You signed in with another tab or window. <a href="">Reload</a> to refresh your session.</span>
      <span class="signed-out-tab-flash">You signed out in another tab or window. <a href="">Reload</a> to refresh your session.</span>
    </div>
  </body>
</html>

