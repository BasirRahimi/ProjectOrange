export default {
    beforeMount: function (el, binding, vnode) {
        el.clickOutsideEvent = function (event) {
            // here I check that click was outside the el and his childrens
            if (!(el == event.target || el.contains(event.target))) {
                // and if it did, call method provided in attribute value
                if (typeof binding.value == 'function') binding.value();
            }
        };
        document.body.addEventListener('click', el.clickOutsideEvent);
    },
    unmounted: function (el) {
        document.body.removeEventListener('click', el.clickOutsideEvent);
    }
};
