{$FlashMessage}

<section class="survey section">
    <div class="container">
        <% include Content %>
        <% if $MailTo %>
            {$SurveyForm}
        <% else %>
            <div class="alert alert-warning">
                Please choose an email address for the survey page to send to.
            </div><!-- /.alert alert-warning -->
        <% end_if %>
    </div><!-- /.container -->
</section><!-- /.survey section -->