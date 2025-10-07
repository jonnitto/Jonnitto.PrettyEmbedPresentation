import Methods from './Plugins/Methods';

let registered = false;
const registerPlugin = () => {
    if (registered) {
        return;
    }
    window.Alpine.plugin(Methods);
    registered = true;
};

window.addEventListener('prettyembed:init', registerPlugin);
window.addEventListener('alpine:init', registerPlugin);
