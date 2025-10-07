import Consent from './Plugins/Consent';

let registered = false;
const registerPlugin = () => {
    if (registered) {
        return;
    }
    window.Alpine.plugin(Consent);
    registered = true;
};

window.addEventListener('prettyembed:init', registerPlugin);
window.addEventListener('alpine:init', registerPlugin);
