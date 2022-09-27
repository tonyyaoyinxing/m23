var config = {
    paths: {
        blockElement: 'Silk_CmsTool/js/blockElement',
        Vue: 'Silk_CmsTool/js/vue',
        vue: 'Silk_CmsTool/js/lib/require-vuejs',
        Vddl: 'Silk_CmsTool/js/lib/vddl',
        'vue-select': 'Silk_CmsTool/js/lib/vue-select',
        'vue-treeselect': 'Silk_CmsTool/js/lib/vue-treeselect',
        uuid: 'Silk_CmsTool/js/lib/uuidv4.min',
        vdr: 'Silk_CmsTool/js/lib/vue-drag-resize'
    },
    shim: {
        'Vue': { 'exports': 'Vue' }
    },
    config: {
        mixins: {
          "Magento_Ui/js/modal/modal-component": {
            "Silk_CmsTool/js/mixins/modal-mixin": true
          }
        }
    },
};