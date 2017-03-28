



<?php
$max_columns = 3; //columns will arrange to any number (as long as it is evenly divisible by 12)
$column = 12/$max_columns; //column number
$total_items = $loop->post_count;
$remainder = $loop->post_count%$max_columns; //how many items are in the last row
$first_row_item = ($total_items - $remainder); //first item in the last row
?>

<?php $i=0; // counter ?>

<?php while ( have_posts() ) : the_post(); ?> 

    <?php if ($i%$max_columns==0) { // if counter is multiple of 3 ?>
    <div class="row">
    <?php } ?>

    <?php if ($i >= $first_row_item) { //if in last row ?>   
    <div class="col-md-<?php echo 12/$remainder; ?>">
    <?php } else { ?>
    <div class="col-md-<?php echo $column; ?>">
    <?php } ?>
        Content...
    </div>        

    <?php $i++; ?>

    <?php if($i%$max_columns==0) { // if counter is multiple of 3 ?>
    </div>
    <?php } ?>

<?php endwhile; ?>

<?php if($i%$max_columns!=0) { // put closing div if loop is not exactly a multiple of 3 ?>
</div>
<?php } ?>