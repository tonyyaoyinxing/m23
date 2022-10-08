<template>
    <div id="app">
        <div class="panel__heading">
            <div class="panel__collapse" />

            <div class="panel__heading-text">
                <span>{{ config.translation.nodes }}</span>
            </div>
            <div>
                <button
                    class="panel__buttom panel__buttom--image"
                    :title="config.translation.append"
                    @click.prevent="addElement()"
                />
                <button
                    class="panel__buttom panel__buttom--append"
                    :title="config.translation.append"
                    @click.prevent="addElement()"
                />
            </div>
        </div>
        <div class="list" id="list">
            <vue-drag-resize v-for="(rect, index) in element"
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
        'Vue',
        'uuid'
    ], function(Vue, uuid) {
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
                    pages: [
                        { pageNumber: 1, width: 500, height: 1000 },
                        { pageNumber: 2, width: 600, height: 1100 },
                        { pageNumber: 3, width: 550, height: 300 }
                    ],
                    fields: [
                        {
                        id: "001",
                        pageNumber: 1,
                        left: 100,
                        top: 100,
                        width: 200,
                        height: 30,
                        isActive: false
                        },
                        {
                        id: "002",
                        pageNumber: 1,
                        left: 100,
                        top: 200,
                        width: 100,
                        height: 30,
                        isActive: false
                        },
                        {
                        id: "003",
                        pageNumber: 2,
                        left: 400,
                        top: 120,
                        width: 50,
                        height: 30,
                        isActive: false
                        }
                    ]
                };
            },
            props: {
                element: {
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
                    
                },
                addElement: function() {
                    this.element.push({
                        width: 100,
                        height: 100,
                        left: 10,
                        top: 10,
                        isActive: true
                    });
                }
            },
            template: template
        });
    });
</script>
<style>
    body {
        height: 100vh;
        width: 100vw;
        background-color: #ECECEC;
    }

    #app {
        margin: 0;
        box-sizing: border-box;
        width: 100%;
        height: 100%;
        position: relative;
        font-family: 'Lato', sans-serif;
    }

    .filler {
        width: 100%;
        height: 100%;
        display: inline-block;
        position: absolute;
        border:1px solid #666666;
    }

    .list {
        position: absolute;
        top: 30px;
        bottom: 30px;
        left: 10px;
        right: 10px;
        box-shadow: 0 0 2px #AAA;
        background-color: white;
    }

    .box-shaddow {
        box-shadow:  10px 10px 15px 0px rgba(125,125,125,1);
    }
</style>
