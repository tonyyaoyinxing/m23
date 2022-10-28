<template>
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
                            :parentLimitation="true"
                            :snapToGrid="rect.snapToGrid"
                            :aspectRatio="rect.aspectRatio"
                            :z="rect.zIndex"
                            :contentClass="rect.class"
                            v-on:activated="activateEv(index)"
                            v-on:deactivated="deactivateEv(index)"
                            v-on:dragging="changePosition($event, index)"
                            v-on:resizing="changeSize($event, index)"
                            :type="rect.type"
                            :imageUrl="rect.imageUrl"
                            :headline="rect.headline"
            >
                <div class="filler" :style="{backgroundColor:rect.color}">
                    <template v-if="rect.type === '0'">
                      <img :src="rect.imageUrl" alt="" width="100%" height="100%">
                    </template>
                    <template v-else-if="rect.type === '1'">
                      <a><img :src="rect.imageUrl" alt="" width="100%" height="100%"></a>
                    </template>
                    <template v-else-if="rect.type === '2'">
                      <div class="{rect.class}" :style="{fontWeight:rect.fontWeight,fontStyle:rect.fontStyle,color:rect.fontColor,fontSize:rect.fontSize,textAlign:rect.fontPosition,lineHeight:rect.height+'px'}">{{rect.headline}}</div>
                    </template>
                    <template v-else-if="rect.type === '3'">
                      <flip-countdown :deadline="rect.deadline"></flip-countdown>
                    </template>
                    <template v-else-if="rect.type === '4'">
                      <p class="{rect.class}">{{rect.headline}}</p>
                    </template>
                    <template v-else>
                      <p class="{rect.class}">{{rect.headline}}</p>
                    </template>
                </div>
            </vue-drag-resize>
    </div>
</template>

<script>
    define([
        'Vue',
        'uuid'
    ], function(Vue) {
        Vue.component('cmstool-block', {
            data() {
                return {
                    listWidth: 0,
                    listHeight: 0,
                    currentField: {},
                    minw: 20,
                    minh: 20,
                    draggable: false,
                    resizable: true,
                    zIndex: 1,
                    parentLim: true,
                    snapToGrid: false,
                    aspectRatio: false,
                    axis: "both",
                };
            },
            props: {
                elements: {
                    type: Array,
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
