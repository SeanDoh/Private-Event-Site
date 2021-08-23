<a href="$RedirectLink" class="tile" style="background-image: url($Image.URL); height: $TileHeight;">
  <% if $BorderImage %>
    <div class="tile-border" style="background-image: url($BorderImage.URL)">
      <div class="tile-content-container">
        $TextImage
      </div>
    </div>
  <% else_if $BackgroundSVGBase64 %>
    <div class="tile-border" style="background-image: url($BackgroundSVGBase64)">
      <div class="tile-content-container">
        $TextImage
      </div>
    </div>
  <% else %>
    <div class="tile-border">
      <div class="tile-content-container">
        $TextImage
      </div>
    </div>
  <% end_if %>
</a>