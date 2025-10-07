import Consent from './Plugins/Consent';
import Media from './Plugins/Media';
import Methods from './Plugins/Methods';
import Popup from './Plugins/Popup';
import Vimeo from './Plugins/Vimeo';
import YouTube from './Plugins/YouTube';

let registered = false;
const registerPlugins = () => {
    if (registered) {
        return;
    }
    window.Alpine.plugin([Consent, Media, Methods, Popup, Vimeo, YouTube]);
    registered = true;
};

window.addEventListener('prettyembed:init', registerPlugins);
window.addEventListener('alpine:init', registerPlugins);
