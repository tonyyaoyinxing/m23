define(['vue'], function (Vue) {
    return function () {
        Vue.component('btn', {
            props: ['text'],
            template: '<button>{{ text }}</button>'
        });
    }
});