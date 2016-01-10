<?hh

require 'vendor/facebook/xhp-lib/init.php';


class :fb:friends-list extends :x:element {
  attribute int friendsof @required;
  use XHPAsync;

  protected async function asyncRender(): Awaitable<XHPRoot> {
    //$friends = await FriendsFetcher::fetch($this->:friendsof);

        $friends = ['Bob', 'Mike'];

        $root = <ul />;
    foreach ($friends as $friend) {
      $root->appendChild(<li>{$friend}</li>);
    }
    return $root;
  }
}

$fred = 1;
$bob = 2;

$xhp =
  <div>
    <h1>Friends of Fred</h1>
    <fb:friends-list friendsof={$fred} />
    <h1>Friends of Bob</h1>
    <fb:friends-list friendsof={$bob} />
  </div>;


$href = 'http://www.facebook.com';
echo <a href={$href}>Facebook</a>;


echo  "\n",
      $xhp->toString();
