<template>
    <div id="app">
        <div class="list-toolbar">
            <c-button :elements="elements" :title="config.translation.text"></c-button>
            <!-- <c-button :elements="elements" :title="config.translation.image"></c-button>
            <c-button :elements="elements" :title="config.translation.background"></c-button>
            <c-button :elements="elements" :title="config.translation.video"></c-button>
            <c-button :elements="elements" :title="config.translation.product"></c-button>
            <c-button :elements="elements" :title="config.translation.category"></c-button>
            <c-button :elements="elements" :title="config.translation.countdown"></c-button> -->
        </div>
        
        <div class="list" id="list">
            <vue-drag-resize v-for="(rect, index) in elements"
                           :key="index"
                           :w="rect.width"
                           :h="rect.height"
                           :x="rect.left"
                           :y="rect.top"
                           :parentW="listWidth"
                           :parentH="listHeight"
                           :axis="rect.axis"
                           :isActive="rect.active"
                           :minw="rect.minw"
                           :minh="rect.minh"
                           :isDraggable="rect.draggable"
                           :isResizable="rect.resizable"
                           :parentLimitation="rect.parentLim"
                           :snapToGrid="rect.snapToGrid"
                           :aspectRatio="rect.aspectRatio"
                           :z="rect.zIndex"
                           :contentClass="rect.class"
                           v-on:activated="activateEv(index)"
                           v-on:deactivated="deactivateEv(index)"
                           v-on:dragging="changePosition($event, index)"
                           v-on:resizing="changeSize($event, index)"
            >
                <div class="filler" :style="{backgroundColor:rect.color}"></div>
            </vue-drag-resize>
        </div>
    </div>
</template>

<script>
    define([
        'Vue'
    ], function(Vue) {
        Vue.component('cmstool-block', {
            data() {
                return {
                    listWidth: 0,
                    listHeight: 0,
                    currentField: {},
                    minw: 20,
                    minh: 20,
                    draggable: true,
                    resizable: true,
                    zIndex: 1,
                    parentLim: false,
                    snapToGrid: false,
                    aspectRatio: false,
                    axis: "both",
                };
            },
            props: {
                elements: {
                    type: Array,
                    required: true
                },
                config: {
                    type: Object,
                    required: true
                }
            },
            mounted() {
                let listEl = document.getElementById('list');
                this.listWidth = listEl.clientWidth;
                this.listHeight = listEl.clientHeight;

                window.addEventListener('resize', ()=>{
                    this.listWidth = listEl.clientWidth;
                    this.listHeight = listEl.clientHeight;
                })
            },

            computed: {
                rects() {
                    
                }
            },

            methods: {
                activateEv(index) {
                    
                },

                deactivateEv(index) {
                    
                },

                changePosition(newRect, index) {

                    
                },

                changeSize(newRect, index) {
                    
                }
            },
            template: template
        });
    });
</script>
