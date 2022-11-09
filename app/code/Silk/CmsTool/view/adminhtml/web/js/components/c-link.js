var cLink = {
    template: "<a><div :class=\"rect.buttonStyle\" >{{rect.headline?rect.headline:rect.name}}</div><div class=\"{rect.buttonStyle}\" >¥{{rect.price}}</div></a>",
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