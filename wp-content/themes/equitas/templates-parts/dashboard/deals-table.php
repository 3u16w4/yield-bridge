<div class="bg-white rounded-xl p-8">

    <h3 class="text-xl font-bold mb-6">Active Deal Management</h3>

    <table class="w-full text-sm">

        <thead>
            <tr class="border-b">
                <th>Deal</th>
                <th>Progress</th>
                <th>Investors</th>
                <th>Yield</th>
                <th class="text-right">Target</th>
            </tr>
        </thead>

        <tbody>

        <?php
        $deals = new WP_Query([
            'post_type' => 'deal',
            'posts_per_page' => 5
        ]);

        if ($deals->have_posts()):
            while ($deals->have_posts()): $deals->the_post();
        ?>

            <tr class="border-b">
                <td><?php the_title(); ?></td>
                <td>82%</td>
                <td>412</td>
                <td>14.5%</td>
                <td class="text-right">$2,500,000</td>
            </tr>

        <?php endwhile; wp_reset_postdata(); endif; ?>

        </tbody>
    </table>

</div>