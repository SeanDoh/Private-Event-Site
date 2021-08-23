<% require ThemedJavascript('EventRegistration') %>

<div id="EventRegistrationForm_Container">
  <% if $RegistrationMessage %>
    <div class="Registration_Message">
      Thank you for registering!  You'll be redirected shortly!
    </div>
    <script>
      window.setTimeout(function () {
            window.location = '{$RedirectLink}'
        }, 5000
      );
    </script>
  <% else %>
    $EventRegistrationForm()
  <% end_if %>
</div>