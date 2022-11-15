var cLink = {
    template: "<a><div class=\"c-link\" :style=\"{fontWeight:rect.fontWeight,fontStyle:rect.fontStyle,color:rect.fontColor,fontSize:rect.fontSize,textAlign:'center',lineHeight:rect.height+'px'}\" >{{rect.headline?rect.headline:rect.name}}</div><div class=\"{rect.buttonStyle}\" >¥{{rect.price}}</div></a>",
    name: 'c-link',
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
Vue.component(cLink.name, cLink);