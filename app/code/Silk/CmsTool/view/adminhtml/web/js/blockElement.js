define([
    "Vue",
    "Vddl",
    "vue-select",
    "vue-treeselect",
    "uiRegistry",
    "vueDragResize",
    "vue!Silk_CmsTool/vue/app",
    "vue!Silk_CmsTool/vue/element-type/toolbar"
], function(Vue, Vddl, vueSelect, vueTreeselect, registry,vueDragResize) {

    return function(config, element) {
        var dependencies = [];
        if (config.vueComponents && config.vueComponents.length > 0) {
            dependencies = config.vueComponents;
        }
        require(dependencies, function() {
            // Vue.use(Vddl);
            // Vue.component('v-select', vueSelect.VueSelect);
            // Vue.component('treeselect', vueTreeselect.Treeselect);
            Vue.use(vueDragResize);
            // Vue.component('vue-drag-resize', vueDragResize.vueDragResize);
            // Vue.component('toolbar', toolbar.toolbar);
            var app = new Vue({
                el: config.el || "#cmstool-block",
                data: config.data
            });
            registry.set('vueApp', app);
        });
    }
});
