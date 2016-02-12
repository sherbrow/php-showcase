
namespace ShowcaseBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TransControllerTest extends WebTestCase
{
    public function testWelcome()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/welcome');
    }

}
