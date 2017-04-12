<?php



?>
<div class="page-wrap">
        <div class="parallax">
            <div id="title">
                <div>
                    <h1>BILLET SIMPLE POUR L'ALASKA</h1>
                </div>
            </div>
        </div>

        <div class="col-sm-12" id="top_layer">
           <div>
                <h2>Jean Forteroche</h2>
           </div>
            <div class="intro col-sm-12">
                <div class="intro_text">
                <p> Vivamus ac lorem sollicitudin, dignissim dui in, finibus mauris. Praesent quis arcu id ligula pretium sollicitudin. Praesent sagittis, diam fermentum porttitor euismod, turpis sapien rutrum ipsum, at venenatis nisl libero ac nibh. Sed in nibh quis justo tincidunt ullamcorper.
                    Morbi elementum, nisi et viverra congue, nibh tortor posuere neque, nec sollicitudin ipsum tellus vel nunc. Nulla facilisi. Fusce condimentum sem eget odio blandit, nec molestie nulla</p>
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec laoreet nunc erat, sit amet lobortis ante eleifend at. Nam vitae massa viverra,
                    luctus risus eu, tincidunt nisl. Vestibulum viverra nibh in imperdiet finibus. Donec malesuada semper arcu, sit amet convallis lacus placerat in.
                    Nam consequat, eros in sollicitudin varius, leo quam pulvinar mauris, in tincidunt felis magna vel lectus. Mauris posuere mauris eu blandit molestie. Nullam non tempus odio.
                    Suspendisse faucibus hendrerit porta. Curabitur tincidunt semper luctus. Duis eu ullamcorper ipsum.
                    Aliquam tristique dolor ante. Nulla ac massa consequat, semper metus.</p>
                </div>
            </div>
        </div>

    <div class="col-sm-12" id="portrait">

        <div class="col-sm-6" id="portrait_text">
            <p id="portrait_text_1">Advenit post multos Scudilo Scutariorum tribunus velamento subagrestis ingenii persuasionis opifex callidus.
                qui eum adulabili sermone seriis admixto solus omnium proficisci pellexit vultu adsimulato
                saepius replicando quod flagrantibus votis eum videre frater cuperet patruelis, siquid per inprudentiam gestum est r
                emissurus ut mitis et clemens, participemque eum suae maiestatis adscisceret, futurum laborum quoque socium, quos Arctoae provinciae diu fessae poscebant.</p>

            <p id="portrait_text_2">Cyprum itidem insulam procul a continenti discretam et portuosam inter municipia crebra urbes duae faciunt claram Salamis et Paphus, altera Iovis delubris altera
                Veneris templo insignis. tanta autem tamque multiplici fertilitate abundat rerum omnium eadem Cyprus ut nullius externi indigens adminiculi indigenis viribus a
                fundamento ipso carinae ad supremos usque carbasos aedificet onerariam navem omnibusque armamentis instructam mari committat.</p>
        </div>

        <div class="col-sm-6" id="portrait_pict">

        </div>

    </div>

        <div class ="bio col-sm-12">
            <div class ="col-sm-6 books">
                <h3>BIBLIOGRAPHIE</h3>
                <ul class="list-group">
                      <li class="list-group-item">Cras justo odio</li>
                      <li class="list-group-item">Dapibus ac facilisis in</li>
                      <li class="list-group-item">Morbi leo risus</li>
                      <li class="list-group-item">Porta ac consectetur ac</li>
                      <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
            <div class ="col-sm-6 movies">
                <h3>FILMOGRAPHIE</h3>
                <ul class="list-group">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
        </div>


        <div class="flip-holder col-sm-12">
            <?php foreach ($chapter_list as $chapter):;?>
                <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                    <div class="flipper">
                        <div class="front">
                            <span class="chapter_num">Chapitre <?php echo $chapter_number++;?></span>
                        </div>
                        <div class="back">
                            <div class="back-pict"></div>
                            <div class="back-title"><?php echo $chapter->getChapterTitle();?></div>
                                <p><?php  $chapter_body = $chapter->getChapterBody();
                                echo $excerpt->getChapterExcerpt($chapter_body);?></p>
                                <p id="total_chapter_cmt"><?php echo $count_comments->totalCommentsByChapter($chapter->getChapterId());?> <i class="fa fa-comment-o"></i></p>
                         <button class="blue_btn" onclick="location.href='//localhost/blog/chapitre/episode-numéro/<?php echo $chapter->getChapterId();?>'">Lire</button>
                        </div>
                    </div>
                </div>
                <div id="l"></div>
            <?php endforeach;?>
        </div>
</div>





