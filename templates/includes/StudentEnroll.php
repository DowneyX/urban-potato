<div class="mx-auto w-full my-5 container bg-white">
    <ul class="flex flex-col">
        <?php
        foreach ($data as $value) {
            include("StudentCourseEnrollCard.php");
        }
        ?>
    </ul>
</div>