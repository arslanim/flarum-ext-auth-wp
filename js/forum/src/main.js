import { extend } from 'flarum/extend';
import app from 'flarum/app';
import LogInButtons from 'flarum/components/LogInButtons';
import LogInButton from 'flarum/components/LogInButton';

app.initializers.add('arslanim/auth/wp', () => {
  extend(LogInButtons.prototype, 'items', function(items) {
    items.add('wordpress',
      <LogInButton
        className="Button LogInButton--wordpress"
        icon="wordpress"
        path="/auth/wordpress">
        Log In with Wordpress site
      </LogInButton>
    );
  });
});
