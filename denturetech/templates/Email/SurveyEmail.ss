<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>New Survey</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="font-family: sans-serif">
        <table border="0" cellpadding="0" cellspacing="0">
            <% if $Logo %>
                <tr>
                    <td colspan="2" style="padding: 0 0 10px 0;"><a href="{$BaseHref}">{$Logo.setWidth(200)}</a></td>
                </tr>
            <% end_if %>
            <% if $FullName %>
            <tr>
                <td style="padding: 10px 10px 10px 0;vertical-align: top"><strong>From:</strong></td>
                <td style="padding: 10px 0;">{$FullName}</td>
            </tr>
            <% end_if %>
            <% if $QuestionOne %>
                <tr>
                    <td style="padding: 10px 10px 10px 0;vertical-align: top"><strong><% if $QuestionOneLabel %>{$QuestionOneLabel}<% else %>Question One<% end_if %></strong></td>
                    <td style="padding: 10px 0;">{$QuestionOne}</td>
                </tr>
            <% end_if %>
            <% if $QuestionTwo %>
                <tr>
                    <td style="padding: 10px 10px 10px 0;vertical-align: top"><strong><% if $QuestionTwoLabel %>{$QuestionTwoLabel}<% else %>Question Two<% end_if %></strong></td>
                    <td style="padding: 10px 0;">{$QuestionTwo}</td>
                </tr>
            <% end_if %>
            <% if $QuestionThree %>
                <tr>
                    <td style="padding: 10px 10px 10px 0;vertical-align: top"><strong><% if $QuestionThreeLabel %>{$QuestionOneLabel}<% else %>Question Three<% end_if %></strong></td>
                    <td style="padding: 10px 0;">{$QuestionThree}</td>
                </tr>
            <% end_if %>
            <% if $QuestionFour %>
                <tr>
                    <td style="padding: 10px 10px 10px 0;vertical-align: top"><strong><% if $QuestionFourLabel %>{$QuestionFourLabel}<% else %>Question Four<% end_if %></strong></td>
                    <td style="padding: 10px 0;">{$QuestionFour}</td>
                </tr>
            <% end_if %>
            <% if $Message %>
                <tr>
                    <td style="padding: 10px 10px 10px 0;vertical-align: top"><strong>Message:</strong></td>
                    <td style="padding: 10px 0;">{$Message}</td>
                </tr>
            <% end_if %>
        </table>
    </body>
</html>