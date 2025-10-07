import Vimeo from './Plugins/Vimeo';

let registered = false;
const registerPlugin = () => {
    if (registered) {
        return;
    }
    window.Alpine.plugin(Vimeo);
    registered = true;
};

window.addEventListener('prettyembed:init', registerPlugin);
window.addEventListener('alpine:init', registerPlugin);
