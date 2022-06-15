<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <Header/>
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Header from './Header.vue'
    export default {
        name: "App",
        components: {
            Header
        }
    }

</script>
