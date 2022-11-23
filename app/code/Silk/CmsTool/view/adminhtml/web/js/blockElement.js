define([
    "Vue",
    "Vddl",
    "vue-select",
    "vue-treeselect",
    "uiRegistry",
    "vueDragResize",
    "ELEMENT",
    "vue!Silk_CmsTool/vue/app",
    "vue!Silk_CmsTool/vue/element-type/countdown",
    "vue!Silk_CmsTool/vue/element-type/c-button",
    "vue!Silk_CmsTool/vue/element-type/c-link",
    "vue!Silk_CmsTool/vue/element-type/c-link-text",
], function(Vue,Vddl, vueSelect, vueTreeselect, registry,vueDragResize,ELEMENT) {
    return function(config) {
        var dependencies = [];
        if (config.vueComponents && config.vueComponents.length > 0) {
            dependencies = config.vueComponents;
        }
        require(dependencies, function() {
            Vue.use(vueDragResize);
            ELEMENT.install(Vue);
            var app = new Vue({
                el: config.el || "#cmstool-block",
                data: config.data
            });
            registry.set('vueApp', app);
        });
    }
});
