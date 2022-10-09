(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define(factory);
  }(this, (function () {

    var vueToolbar = {
        template: '<span class="vue-toolbar-button-template"v-on="$listeners"v-bind="$attrs"><div id="vue-toolbar-button-copyright"><!--Vue Toolbar Button Copyright(c)2021-2022 Mike Erickson/Codedungeon.All rights reserved.Licensed under the MIT license.See LICENSE in the project root for license information.--></div><span:class="toolbarButtonClass"@click="toggleMenu"><i v-show="icon.length > 0 && !hasIconSlot"style="padding-left: 2px; padding-right: 4px;":class="icon"></i><span v-if="hasIconSlot"class="vue-toolbar-button-icon vue-toolbar-button-icon-slot"><slot name="icon"class="vue-toolbar-button-icon-slot"></slot></span><span:class="hasDefaultSlot ? 'vue-toolbar-button-slot' : null"><slot></slot></span><span v-if="hasArrowSlot"class="vue-toolbar-button-icon arrow"><slot name="arrow"></slot></span><span v-if="!hasArrowSlot && downArrow && options.length > 0":class="arrowSize === 'mini' ? 'arrow vue-toolbar-button-icon-mini' : 'arrow vue-toolbar-button-icon'"><svg class="arrow w-6 h-6"fill="currentColor"style="user-select: auto;"viewBox="0 0 20 20"xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd"d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"clip-rule="evenodd"style="user-select: auto;"></path></svg></span><template v-if="options.length > 0"><ul:data-name="name"class="vue-toolbar-button-dropdown-menu vue-toolbar-button-dropdown"v-show="showMenu"><li:class="
        typeof option === 'object' && option.hasOwnProperty('disabled') && option.disabled
            ? 'vue-toolbar-button-dropdown-menu-item-disabled'
            : 'vue-toolbar-button-dropdown-menu-item'
    ":style="typeof option === 'object' && option.hasOwnProperty('separator') && option.separator ? 'height: 3px; margin-right: 3px' : ''"v-for="(option, idx) in options":key="idx"><a href="javascript:void(0)"@click="onButtonClick(option)"><span style="height: 3px"v-if="typeof option === 'object' && option.hasOwnProperty('separator') && option.separator"><span class="vue-toolbar-button-line"></span></span><span v-else>{{typeof option==="string"?option:option.value}}</span></a></li></ul></template></span></span>',
        name: 'vue-toolbar',
        components: {},
        emits: ["buttonClick"],
        props: {
            name: { type: String, default: "" },
            icon: { type: String, default: "" },
            downArrow: { type: Boolean, default: false },
            arrowSize: { type: String, default: "normal" },
            disabled: { type: Boolean, default: false },
            options: { type: [Array, Object], default: () => [] },
            dropdownOnly: { type: Boolean, default: false },
        },

        data() {
            return {
                showMenu: false,
            }
        },

        methods: {
            onButtonClick(menuItem = "") {
                if (!this.dropdownOnly) {
                    this.showMenu = false
                }

                if (typeof menuItem === "object") {
                    if ((menuItem.hasOwnProperty("disabled") && menuItem.disabled) || (menuItem.hasOwnProperty("separator") && menuItem.separator)) {
                        // do nothing, disabled or separator menu item
                    } else {
                        this.$emit("buttonClick", { name: this.name, slug: menuItem.slug, menuItem: menuItem.value })
                    }
                } else {
                    this.$emit("buttonClick", { name: this.name, menuItem })
                }
            },

            getBodyHeight() {
                const { body, documentElement: html } = document
                return Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight)
            },

            toggleMenu(event) {
                let hasArrow =
                    event.path.filter(item => {
                        return typeof item.className === "string" && item.className.includes("arrow")
                    }).length > 0

                let className = event.path[0].className
                if (className.length === 0 && !this.dropdownOnly) {
                    return
                }

                if (typeof className === "object") {
                    className = className.hasOwnProperty("baseVal") ? className.baseVal : ""
                }

                if ((this.name.length > 0 && hasArrow) || this.dropdownOnly) {
                    if (this.name.length === 0) {
                        console.error(`VueToolbarButton: missing 'name' prop`)
                        return
                    }
                    let menu = document.querySelector(`*[data-name=${this.name}]`)
                    menu.style.left = menu.parentElement.offsetLeft - 10 + "px"

                    let availableHeight = this.getBodyHeight() - menu.parentElement.offsetTop - 50
                    menu.style.maxHeight = availableHeight + "px"

                    if (this.options.length > 0) {
                        this.showMenu = !this.showMenu
                    }
                } else {
                    let name = this.name
                    if (name.length === 0) {
                        name = "missing 'name' prop"
                        console.error(`VueToolbarButton: ${name}`)
                    }

                    if (event.target.className !== "vue-toolbar-button-line") {
                        this.$emit("buttonClick", { name, menuItem: null })
                    }
                }
            },

            clickHandler(event) {
                const { target } = event
                const { $el } = this

                if (!$el.contains(target)) {
                    this.showMenu = false
                }
            },

            getVersion() {
                return VERSION
            },
        },

        beforeDestroy() {
            document.removeEventListener("click", this.clickHandler)
        },

        mounted() {
            if (this.downArrow && this.options.length === 0) {
                console.error(`VueToolbarButton [${this.name}]: When using 'downArrow' prop, you need to also supply 'options' prop`)
            }
            document.addEventListener("click", this.clickHandler)
        },

        computed: {
            hasDefaultSlot() {
                return Object.keys(this.$slots).includes("default")
            },

            hasIconSlot() {
                return Object.keys(this.$slots).includes("icon")
            },

            hasArrowSlot() {
                return Object.keys(this.$slots).includes("arrow")
            },

            toolbarButtonClass() {
                if (this.options.length > 0) {
                    let defaultClass = !this.disabled ? "vue-toolbar-button-with-dropdown" : "vue-toolbar-button-disabled"
                    if (this.showMenu) {
                        defaultClass = "vue-toolbar-button-with-dropdown-open"
                    }
                    return defaultClass
                } else {
                    return !this.disabled ? "vue-toolbar-button" : "vue-toolbar-button-disabled"
                }
            },
        },
    }
    var install = function (Vue) {
      
        Vue.component(vueToolbar.name, vueToolbar);
    
      };
      
      /* eslint no-undef:0 */
      if (typeof window !== 'undefined' && window.Vue) {
        install(window.Vue);
      }
      
      var install$1 = { install: install };
      
      return install$1;

  
  })));