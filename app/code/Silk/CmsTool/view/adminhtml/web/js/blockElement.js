define([
    "Vue",
    "Vddl",
    "vue-select",
    "vue-treeselect",
    "uiRegistry",
    "vueDragResize",
    "toolbar",
    "vue!Silk_CmsTool/vue/app"
], function(Vue, Vddl, vueSelect, vueTreeselect, registry,vueDragResize,toolbar) {

    return function(config, element) {
        var dependencies = [];
        if (config.vueComponents && config.vueComponents.length > 0) {
            dependencies = config.vueComponents;
        }
        require(dependencies, function() {
            // Vue.use(Vddl);
            // Vue.component('v-select', vueSelect.VueSelect);
            // Vue.component('treeselect', vueTreeselect.Treeselect);
            Vue.component('vue-drag-resize', vueDragResize.vueDragResize);
            Vue.component('toolbar', toolbar.toolbar);
            var app = new Vue({
                el: config.el || "#cmstool-block",
                data: config.data
            });
            registry.set('vueApp', app);
        });
    }
});
