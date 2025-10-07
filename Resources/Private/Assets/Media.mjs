import Media from './Plugins/Media';

let registered = false;
const registerPlugin = () => {
    if (registered) {
        return;
    }
    window.Alpine.plugin(Media);
    registered = true;
};

window.addEventListener('prettyembed:init', registerPlugin);
window.addEventListener('alpine:init', registerPlugin);
