import SettingsModal from 'flarum/components/SettingsModal';
import app from 'flarum/app';

export default class WordpressSettingsModal extends SettingsModal {
    
    className() {
        return 'WordpressSettingsModal Modal--large';
    }
    
    title() {
        return 'WP login settings';
    }
    
    form() {
        return [
            <div className="Form-group">
                <label>App settings</label>
                <div className="Form-group--column50">
                    <label>App id</label>
                    <input className="FormControl" bidi={this.setting('arslanim/auth/wp.app_id')}/>
                </div>
                <div className="Form-group--column50">
                    <label>App secret</label>
                    <input className="FormControl" bidi={this.setting('arslanim/auth/wp.app_secret')}/>
                </div>
            </div>,
            
            <div className="Form-group">
                <label>Wordpress site url</label>
                <input className="FormControl" placeholder="http:\\example.com" bidi={this.setting('arslanim/auth/wp.wp_site_url')} />
            </div>
        ];
    }
}