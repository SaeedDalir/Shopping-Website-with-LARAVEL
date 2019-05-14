<template>
    <div>
        <div class="form-group">
            <label>دسته بندی</label>
            <select name="categories[]" class="form-control" multiple="multiple" v-model="categories_selected" @change="onChange($event, null)">
                <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
            </select>
        </div>
        <div v-if="flag">
            <div class="form-group" v-for="(attribute, index) in attributes">
                <label>ویژگی {{attribute.title}}</label>
                <select class="form-control" style="border-color:blue;" @change="addAttribute($event, index)">
                    <option v-if="!product" v-for="attributeValue in attribute.attributes_value" :value="attributeValue.id" class="text-bold text-green">{{ attributeValue.title }}</option>
                    <option v-if="product" v-for="attributeValue in attribute.attributes_value" :value="attributeValue.id" :selected="product.attribute_values[index].id === attributeValue.id" class="text-bold text-green">{{ attributeValue.title }}</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="attributes[]" :value="computedAttribute">
        <div class="form-group">
            <label>برند</label>
            <select name="brand" class="form-control">
                <option v-if="!product" v-for="brand in brands" :value="brand.id" class="text-bold text-green">{{ brand.title }}</option>
                <option v-if="product" v-for="brand in brands" :value="brand.id" :selected="product.brand.id === brand.id" class="text-bold text-green">{{ brand.title }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories : [],
                categories_selected : [],
                flag : false,
                attributes : [],
                selectedAttribute : [],
                computedAttribute : []
            }
        },
        props : ['brands','product'],
        mounted() {
            axios.get('/api/categories').then(res => {
                this.getAllChildren(res.data.categories, 0)
            }).catch(err => {
                console.log(err)
            })
            if (this.product){
                for (var i=0 ; i<this.product.categories.length ; i++){
                    this.categories_selected.push(this.product.categories[i].id)
                }
                for (var i=0; i<this.product.attribute_values.length ; i++){
                    this.selectedAttribute.push({
                        'index' : i,
                        'value' : this.product.attribute_values[i].id
                    })
                    this.computedAttribute.push(this.product.attribute_values[i].id)
                }
                const load = 'ok'
                this.onChange(null,load);
            }
        },
        methods : {
            getAllChildren : function (currentValue,level) {
                for(var i=0 ; i<currentValue.length ; i++){
                    var current = currentValue[i];
                    this.categories.push({
                        id : current.id,
                        title : Array(level + 1).join("  -  -  ") + " " + current.title
                    })
                    if(current.children_recursive && current.children_recursive.length > 0){
                        this.getAllChildren(current.children_recursive, level + 1)
                    }
                }
            },
            onChange : function (event, load) {
                this.flag = false;
                axios.post('/api/categories/attribute',this.categories_selected).then(res => {
                    if (this.product && load == null){
                        this.computedAttribute = []
                        this.selectedAttribute = []
                    }
                    this.attributes = res.data.attributes
                    this.flag = true
                }).catch(err => {
                    console.log(err)
                    this.flag = false
                })
            },
            addAttribute : function (event, index) {
                for (var i=0; i<this.selectedAttribute.length ; i++){
                    var current = this.selectedAttribute[i];
                    if(current.index === index){
                        this.selectedAttribute.splice(i,1)
                    }
                }
                this.selectedAttribute.push({
                    'index' : index,
                    'value' : event.target.value
                })
                this.computedAttribute = []
                for (var i=0; i<this.selectedAttribute.length ; i++){
                    this.computedAttribute.push(this.selectedAttribute[i].value)
                }
            }
        }
    }
</script>
