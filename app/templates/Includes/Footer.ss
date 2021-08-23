<footer class="footer">
  <div class="container">
    <div class="columns">
      <div class="column is-6">
        <% loop $Menu(1) %>
          <% if $Footer %>
            <a class="navbar-item $LinkingMode" href="$Link" title="$Title.XML">$MenuTitle.XML</a>
          <% end_if %>
        <% end_loop %>
      </div>
    </div>
  </div>
</footer>