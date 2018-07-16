<h1 class="mt-3"><?=$news['title']?></h1>

        <div class="row mt-3">
            <div class="col-8">
                <div class="media">
                    <img class="mr-3 img-thumbnail" style="max-width: 200px" src="/<?=$news['photo']?>" alt="Generic placeholder image">
                    <div class="media-body">
                        <p><?=$news['text']?></p>
                        <hr>
                        <? if(!empty($news['file1'])):?>
                            <p><a href="/<?=$news['file1']?>"><?=$news['file1_name']?></a></p>
                        <? endif;?>
                        <? if(!empty($news['file2'])):?>
                            <p><a href="/<?=$news['file2']?>"><?=$news['file2_name']?></a></p>
                        <? endif;?>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <p><i class="far fa-calendar-alt"></i> Дата: <?= $news['date']?></p>
                <p><i class="far fa-eye"></i> Просмотры: <?= $news['views']?></p>
                <p><i class="far fa-user"></i> Автор: <a href="/account/profile/<?=$news['user_id']?>"><?=$news['last_name'].' '.$news['first_name'].' '.$news['middle_name']; ?></a></p>
            </div>
        </div>


<!--<div class="row justify-content-md-center">-->
<!--    <div class="col-9">-->
<!---->
<!--<ul class="list-unstyled">-->
<!--    <li class="media">-->
<!--        <img class="mr-3" src="http://service.local/files/news_photo/crimea.jpg" style="max-width: 100px" alt="Generic placeholder image">-->
<!--        <div class="media-body">-->
<!--            <h5 class="mt-0 mb-1">Медиа объект на основе списка</h5>-->
<!--            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.-->
<!--        </div>-->
<!--    </li>-->
<!--    <li class="media my-4">-->
<!--        <img class="mr-3" src="http://service.local/files/news_photo/crimea.jpg" style="max-width: 100px" alt="Generic placeholder image">-->
<!--        <div class="media-body">-->
<!--            <h5 class="mt-0 mb-1">Медиа объект на основе списка</h5>-->
<!--            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.-->
<!--        </div>-->
<!--    </li>-->
<!--    <li class="media">-->
<!--        <img class="mr-3" src="http://service.local/files/news_photo/crimea.jpg" style="max-width: 100px" alt="Generic placeholder image">-->
<!--        <div class="media-body">-->
<!--            <h5 class="mt-0 mb-1">Медиа объект на основе списка</h5>-->
<!--            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.-->
<!--        </div>-->
<!--    </li>-->
<!--</ul>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!---->


<div class="row justify-content-md-center">
    <div class="col-9">


    </div>
</div>