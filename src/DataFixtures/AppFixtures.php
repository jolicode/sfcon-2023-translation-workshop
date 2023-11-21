<?php

namespace App\DataFixtures;

use App\Factory\ArticleFactory;
use App\Factory\CategoryFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'email' => 'admin@symfony.com',
            'name' => 'Admin',
            'roles' => ['ROLE_ADMIN'],
        ]);
        UserFactory::createMany(5);
        CategoryFactory::createMany(5);

        $restaurants = [
            [
                'name' => 'Wolf Food Market',
                'description' => "Wolf, it was the place \"of the wolves of finance\", after having been the one where real wolves came to drink, according to legend. Hence the name of the street, \"Fossé aux Loups\", near the Cathedral of Saints Michael and Gudule. Today, it is a street food market where you can experience a real culinary experience: through 19 restaurants and two bars, take a tour of the world of gastronomy by tasting burgers and sushi, through pasta and Syrian-Lebanese breads. Let yourself be tempted by poke bowls or the gourmet waffles of the well-known chef Yves Matagne. To finish your meal, go and relax in the chill room and, before leaving, go to the Food Hub, the organic and zero waste market of this temple of gastronomy.<br><br><img src='https://www.visit.brussels/content/dam/visitbrussels/images/b2c/where-to-eat/street-food/Wolf_@Wolf_4000x2667.jpg/jcr:content/renditions/cq5dam.zoom.2048.2048.jpeg' alt=''/>",
            ],
            [
                'name' => 'My Tannour',
                'description' => "My Tannour is a Syrian canteen run by Georges, the chef of Armenian and Lebanese origin, who grew up in Syria. When you enter, you will first see the two large clay bread ovens, the tannours, from which the sign takes its name. You will then see the wrought iron oven, which is used to cook kilos of meat, chicken, beef, lamb. At Georges', you eat tannours, these Syrian breads baked in the oven and shaped on site by the chef, garnished with meat or, for vegans, falafels or eggplant caviar for example. To enjoy a delicious tannour, head to Ixelles, Saint-Gilles or the Wolf in the city center (see above).<br><br><img src='https://www.visit.brussels/content/dam/visitbrussels/images/b2c/where-to-eat/street-food/My%20Tannour_@Delphine%20Lang_3267x3267.jpg/jcr:content/renditions/cq5dam.zoom.2048.2048.jpeg' alt=''/>",
            ],
            [
                'name' => 'Liu Lin',
                'description' => "From the first names of the two sisters of Taiwanese origin who run this establishment in Sablon, Liu Lin invites you to taste the cuisine of their country but entirely vegan. The names of the dishes in the menu will disturb you at first sight since you will find meat names, and the products in your plate will also look like it, but you will discover by tasting the dishes of the two chefs that you have been deceived! You will surely be seduced by this vegan cuisine that makes you taste tofu, soy or shiitake. If you are a carnivore, you will certainly convert to the vegetable, which is the goal of Liu and Lin.<br><br><img src='https://www.visit.brussels/content/dam/visitbrussels/images/b2c/where-to-eat/restaurants-v%C3%A9g%C3%A9/Liu%20Lin_@Dylan%20Berrier_6000x4000.jpg/jcr:content/renditions/cq5dam.zoom.2048.2048.jpeg' alt=''/>"
            ],
            [
                'name' => 'Fernand Obb Delicatessen',
                'description' => "From the name of his cat Fernand and the expression \"Ob Bruxelles\" to designate the municipality of Saint-Gilles in the past, Fernand Obb is a Belgian popular cuisine counter created by Cédric Mosbeux in 2017 and open since 2018. It is both a restaurant, a caterer, a delicatessen and an event venue. Its menu is based on Belgian products and its dishes are prepared on site or by local artisans. At Fernand Obb, the shrimp is queen! You can enjoy the pistolet with shrimp croquettes and taste the best gray shrimp croquette in Brussels. Cédric has indeed won the prize, twice, in 2018 and 2019. Also taste burgers, homemade smoked salmon or \"gaufrites\", potatoes fried in the shape of waffles. All this next to the water carrier painted on a ceramic wall, an emblematic figure of Saint-Gilles.<br><br><img src='https://www.visit.brussels/content/dam/visitbrussels/images/b2c/where-to-eat/street-food/Fernand%20Obb_@Eric%20Danhier_9000x6000.jpg/jcr:content/renditions/cq5dam.zoom.2048.2048.jpeg' alt=''/>"
            ],
            [
                'name' => 'Fox',
                'description' => "Want to taste street food in an exceptional environment?  Go to the green Watermael-Boitsfort. Set in an impressive brutalist building on the edge of the Sonian Forest, discover The Mix. This imposing complex includes a hotel, a fitness center, a spa and a food market, the Fox.  The latter is located on the ground floor, has a magnificent terrace and offers you a beautiful offer in streetonomie mode, a term specially created for the place. Travel through exotic flavors from Mexico, South Korea, Italy, the United States, Japan and many other gourmet horizons.  To end your culinary experience, nothing like walking around or treating yourself to a workout in the superb facilities of The Mix.<br><br><img src='https://www.visit.brussels/content/dam/visitbrussels/images/b2c/where-to-eat/street-food/Fox%20.jpg/jcr:content/renditions/cq5dam.zoom.2048.2048.jpeg' alt=''/>"
            ],
            [
                'name' => 'Panam',
                'description' => "The offer of kebabs in Brussels is quite. Among the young generation of döner establishments, Panam stands out in particular. You can go there every day to taste artisanal kebabs. The bread comes from the excellent Renard bakery, located right next door. The fries are hand cut and delicious. Here you eat the highest quality Turkish street food. A \"Berliner kebab\" as they say. Healthy, local, fresh, affordable and super tasty!<br><br><img src='https://www.visit.brussels/content/dam/visitbrussels/images/b2c/where-to-eat/street-food/Smash_1080x721.jpg/jcr:content/renditions/medium-1280px.jpeg' alt=''/>"
            ],
            [
                'name' => 'Rambo',
                'description' => "If you ask a Brussels gourmet where to eat the best burgers in the capital, there is a good chance that he will answer Rambo. At Rambo, we smash the burger in three versions: the classic, the special and the nomeat.  The result is an explosion of flavors. Crunchy at the first bite, melting in the mouth, a real delight. Here, the art of smash is mastered to perfection and without a tennis racket. Rambo is the first address to have offered these particular burgers in Belgium. Find them in the heart of the Châtelain district, in American diner version or in Saint-Boniface in take away mode only.<br><br><img src='https://www.visit.brussels/content/dam/visitbrussels/images/b2c/where-to-eat/street-food/Rambo.jpg/jcr:content/renditions/cq5dam.zoom.2048.2048.jpeg' alt=''/>"
            ]
        ];
        foreach ($restaurants as $restaurant) {
            ArticleFactory::createOne([
                'title' => $restaurant['name'],
                'content' => $restaurant['description'],
            ]);
        }
    }
}
