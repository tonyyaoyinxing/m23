var cButton = {
    template: "<a class=\"c-button\" :style=\"{fontWeight:rect.fontWeight,fontStyle:rect.fontStyle,color:rect.fontColor,fontSize:rect.fontSize,lineHeight:rect.height+'px',border:'1px solid '+rect.fontColor}\">{{rect.headline?rect.headline:rect.name}}</a>",
    name: 'c-button',
    data() {
        return {}
    },
    props: {
        rect: {
            type: Object,
            required:true,
        },
    },
    methods: {
        
    }
}
Vue.component(cButton.name, cButton);