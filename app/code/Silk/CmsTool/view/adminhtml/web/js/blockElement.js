define([
    "Vue",
    "Vddl",
    "vue-select",
    "vue-treeselect",
    'uiRegistry',
    "vue!Silk_CmsTool/vue/app",
    "vue!Silk_CmsTool/vue/field-type/autocomplete",
    "vue!Silk_CmsTool/vue/field-type/autocomplete-lazy",
    "vue!Silk_CmsTool/vue/field-type/checkbox",
    "vue!Silk_CmsTool/vue/field-type/image-upload",
    "vue!Silk_CmsTool/vue/field-type/simple-field",
    "vue!Silk_CmsTool/vue/field-type/template-list",
    "vue!Silk_CmsTool/vue/menu-type",
    "vue!Silk_CmsTool/vue/nested-list"
], function(Vue, Vddl, vueSelect, vueTreeselect, registry) {

    return function(config, element) {
        var dependencies = [];

        if (config.vueComponents && config.vueComponents.length > 0) {
            dependencies = config.vueComponents;
        }

        require(dependencies, function() {
            Vue.use(Vddl);
            Vue.component('v-select', vueSelect.VueSelect);
            Vue.component('treeselect', vueTreeselect.Treeselect);
            var app = new Vue({
                el: config.el || "#snowdog-menu",
                data: config.data
            });
            registry.set('vueApp', app);
        });
    }
});
