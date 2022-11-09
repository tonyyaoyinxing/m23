var cButton = {
    template: "<a class=\"c-button\" :class=\"rect.buttonStyle\">{{rect.headline?rect.headline:rect.name}}</a>",
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