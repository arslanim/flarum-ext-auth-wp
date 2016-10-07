import { extend } from 'flarum/extend';
import app from 'flarum/app';

import WordpressSettingsModal from 'arslanim/auth/wp/components/WordpressSettingsModal';

app.initializers.add('arslanim/auth/wp', app => {
  app.extensionSettings['arslanim-auth-wp'] = () => app.modal.show(new WordpressSettingsModal());
});