var cLinkText = {
    template: "<a><div class=\"c-link-text\":style=\"{fontWeight:rect.fontWeight,fontStyle:rect.fontStyle,color:rect.fontColor,fontSize:rect.fontSize,textAlign:'center',lineHeight:rect.height+'px'}\" >{{rect.headline?rect.headline:rect.name}}</div></a>",
    name: 'c-link-text',
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
Vue.component(cLinkText.name, cLinkText);