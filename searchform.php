

<form class="hiden" role="search" method="POST" id="searchform" action="<?php echo admin_url( 'admin-ajax.php?action=search_form_site' ) ?>" >
	<input type="text" value="" name="s" id="s" />
	<input  type="submit" id="searchsubmit" value="" />
    <div id="searchformBlock">
</div>
</form>

<script>
    var linkSearch = document.querySelector('.search a')
    var searchform = document.querySelector('#searchform')
    linkSearch.addEventListener('click', function(){
        linkSearch.classList.add('hiden')
        searchform.classList.remove('hiden')
    })
</script>
<style>
#searchformBlock{
    position: absolute;
    right: 0;
    top: 50px;
    background: #fff;
    width: 250px;
    box-shadow: 0px 0px 15px 0px rgba(0,0,0, 0.2);
}
#searchformBlock li{
    border-bottom: solid 1px;
    margin: 5px 10px;
}

#searchform{
    position: relative;
    display: flex;
    justify-content: center;
    margin: 0px 20px;
}
#searchform #s{
    animation: searchform_animation 0.5s
}
@keyframes searchform_animation{
    0%{
        width: 0px;
    }
    100%{
        width: 170px;
    }
}
#searchsubmit{
    width: 30px;
    display: block;
    height: 30px;
    border: none;
    background: url("<?php echo get_template_directory_uri();?>/assets/img/search.png") 100% no-repeat;
}
#searchsubmit:focus{
    border: none;
    outline: none;
}
.search a.hiden{
    display: none;
}
#searchform.hiden {
    display: none;
}
</style>