'use strict';

System.register('arslanim/auth/wp/components/WordpressSettingsModal', ['flarum/components/SettingsModal', 'flarum/app'], function (_export, _context) {
    "use strict";

    var SettingsModal, app, WordpressSettingsModal;
    return {
        setters: [function (_flarumComponentsSettingsModal) {
            SettingsModal = _flarumComponentsSettingsModal.default;
        }, function (_flarumApp) {
            app = _flarumApp.default;
        }],
        execute: function () {
            WordpressSettingsModal = function (_SettingsModal) {
                babelHelpers.inherits(WordpressSettingsModal, _SettingsModal);

                function WordpressSettingsModal() {
                    babelHelpers.classCallCheck(this, WordpressSettingsModal);
                    return babelHelpers.possibleConstructorReturn(this, (WordpressSettingsModal.__proto__ || Object.getPrototypeOf(WordpressSettingsModal)).apply(this, arguments));
                }

                babelHelpers.createClass(WordpressSettingsModal, [{
                    key: 'className',
                    value: function className() {
                        return 'WordpressSettingsModal Modal--large';
                    }
                }, {
                    key: 'title',
                    value: function title() {
                        return 'WP login settings';
                    }
                }, {
                    key: 'form',
                    value: function form() {
                        return [m(
                            'div',
                            { className: 'Form-group' },
                            m(
                                'label',
                                null,
                                'App settings'
                            ),
                            m(
                                'div',
                                { className: 'Form-group--column50' },
                                m(
                                    'label',
                                    null,
                                    'App id'
                                ),
                                m('input', { className: 'FormControl', bidi: this.setting('arslanim-auth-wp.app_id') })
                            ),
                            m(
                                'div',
                                { className: 'Form-group--column50' },
                                m(
                                    'label',
                                    null,
                                    'App secret'
                                ),
                                m('input', { className: 'FormControl', bidi: this.setting('arslanim-auth-wp.app_secret') })
                            )
                        ), m(
                            'div',
                            { className: 'Form-group' },
                            m(
                                'label',
                                null,
                                'Wordpress site url'
                            ),
                            m('input', { className: 'FormControl', placeholder: 'http:\\\\example.com', bidi: this.setting('arslanim-auth-wp.wp_site_url') })
                        )];
                    }
                }]);
                return WordpressSettingsModal;
            }(SettingsModal);

            _export('default', WordpressSettingsModal);
        }
    };
});;
'use strict';

System.register('arslanim/auth/wp/main', ['flarum/extend', 'flarum/app', 'arslanim/auth/wp/components/WordpressSettingsModal'], function (_export, _context) {
  "use strict";

  var extend, app, WordpressSettingsModal;
  return {
    setters: [function (_flarumExtend) {
      extend = _flarumExtend.extend;
    }, function (_flarumApp) {
      app = _flarumApp.default;
    }, function (_arslanimAuthWpComponentsWordpressSettingsModal) {
      WordpressSettingsModal = _arslanimAuthWpComponentsWordpressSettingsModal.default;
    }],
    execute: function () {

      app.initializers.add('arslanim/auth/wp', function (app) {
        app.extensionSettings['arslanim-auth-wp'] = function () {
          return app.modal.show(new WordpressSettingsModal());
        };
      });
    }
  };
});