<template>
    <div id="app">
        <div class="list-toolbar">
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
                    ],
                    icon: false,
                    debug: false,
                    info: "",
                    version: "",
                    test: "Timmy",
                    family: ["Mike", "Kira", "Joelle", "Brady", "Trevor"],
                    options: [
                        "item 1",
                        "item 2",
                        "item 3",
                        "item 4",
                        "item 5",
                        "item 5",
                        "item 6",
                        "item 7",
                        "item 8",
                        "item 9",
                        "item 10",
                        "item 11",
                        "item 12",
                        "item 13",
                        "item 14",
                        "item 15",
                        "item 16",
                        "item 17",
                        "item 18",
                        "item 19",
                        "item 20",
                    ],
                    optionsObject: [
                        { slug: "item-one", value: "item 1", disabled: false },
                        { slug: "item-two", value: "item 2", disabled: false },
                        { slug: "item-three", value: "item 3 (disabled)", disabled: true },
                        { slug: "item-four", value: "item 4", disabled: false, separator: true },
                        { slug: "item-five", value: "item 5", disabled: false },
                    ],
                    newOptions: ["item 1", "item 2", "item 3", "item 4", "item 5", "item 5"],
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
                },
                handleCloseMessage() {
                    console.log("Vue Messenger Event: close messasge event")
                },
                titleMessageOnly(type = "default") {
                    this.$refs["vue-messenger"].updateMessage({ type, title: "Title", icon: this.icon, debug: this.debug })
                },
                textMessageOnly(type = "default") {
                    this.$refs["vue-messenger"].updateMessage({ type, description: "Text Only", icon: this.icon, debug: this.debug })
                },
                updateMessage(type = "info", more = null) {
                    this.$refs["vue-messenger"].updateMessage({
                        type,
                        title: "Message Title",
                        description: "Message Description",
                        more,
                        moreLinkdescription: "click me",
                        icon: this.icon,
                        debug: this.debug,
                    })
                },

                onButtonClick(data) {
                    this.info = JSON.stringify(data)
                        .replaceAll(",", ", ")
                        .replaceAll(":", ": ")

                    if (data.name.includes("missing")) {
                        return
                    }

                    console.warn("onButtonClick: ", this.info)
                    this.$refs["vue-messenger"].updateMessage({ type: "info", title: data.name, description: this.info, icon: true })
                },
            },
            template: template
        });
    });
</script>
