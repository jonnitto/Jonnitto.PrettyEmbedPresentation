import YouTube from './Plugins/YouTube';

let registered = false;
const registerPlugin = () => {
    if (registered) {
        return;
    }
    window.Alpine.plugin(YouTube);
    registered = true;
};

window.addEventListener('prettyembed:init', registerPlugin);
window.addEventListener('alpine:init', registerPlugin);
