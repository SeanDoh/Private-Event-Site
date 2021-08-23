<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
  <div class="container">
    <div class="navbar-brand">
      <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>

    <div class="navbar-menu">
      <div class="navbar-start">
        <% loop $Menu(1) %>
          <% if not $Footer %>
            <a class="navbar-item $LinkingMode" href="$Link" title="$Title.XML">$MenuTitle.XML</a>
          <% end_if %>
        <% end_loop %>
      </div>
    </div>
  </div>
</nav>