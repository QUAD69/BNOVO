<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Forms\GuestComposeForm;
use App\Models\Guest;
use Phalcon\Http\Response;
use Phalcon\Paginator\Adapter\Model;

class GuestController extends BaseController
{
    public function browseAction(): Response
    {
        $page = $this->request->getQuery('page', 'int', 1);
        $limit = $this->request->getQuery('limit', 'int', 10);
        $limit = max(1, min(100, $limit));

        $pagination = new Model([
            'model' => Guest::class,
            'limit' => $limit,
            'page' => $page
        ]);

        $paginate = $pagination->paginate();

        return $this->setResponse(206, [
            'total' => $paginate->getTotalItems(),
            'items' => $paginate->getItems()->toArray()
        ]);
    }

    public function viewAction($id): Response
    {
        /** @var Guest $guest */
        if (!$guest = Guest::findFirstById($id)) {
            return $this->setResponse(404, [
                'cause' => 'guest with specified id not found'
            ]);
        }

        return $this->setResponse(200, [
            'id' => $guest->getId(),
            'first_name' => $guest->getFirstName(),
            'last_name' => $guest->getLastName(),
            'country' => $guest->getCountry(),
            'email' => $guest->getEmail(),
            'phone' => $guest->getPhone()
        ]);
    }

    public function deleteAction($id): Response
    {
        $guest = Guest::findFirstById($id);

        if (!$guest) {
            return $this->setResponse(404, [
                'cause' => 'guest with specified id not found'
            ]);
        }

        if (!$guest->delete()) {
            return $this->setResponse(500, [
                'cause' => 'cant delete guest'
            ]);
        }

        return $this->setResponse(200, ['cause' => 'guest successful deleted']);
    }

    public function composeAction(mixed $id = null): Response
    {
        $isEdit = !empty($id);
        $guest = $isEdit ? Guest::findFirstById($id) : new Guest();

        if (!$guest) {
            return $this->setResponse(404, [
                'cause' => 'guest with specified id not found'
            ]);
        }

        $composeForm = new GuestComposeForm();

        if (!$composeForm->isValid($_POST)) {
            $messages = $composeForm->getMessages();
            $messages = iterator_to_array($messages);
            $messages = array_map('strval', $messages);

            return $this->setResponse(404, [
                'errors' => $messages
            ]);
        }

        $guest->setFirstName($composeForm->getValue('first_name'));
        $guest->setLastName($composeForm->getValue('last_name'));
        $guest->setCountry($composeForm->getValue('country'));
        $guest->setEmail($composeForm->getValue('email'));
        $guest->setPhone($composeForm->getValue('phone'));

        if (!$guest->save()) {
            return $this->setResponse(500, [
                'cause' => 'cant save guest'
            ]);
        }

        return $this->setResponse($isEdit ? 200 : 201, [
            'guest_id' => $guest->getId()
        ]);
    }
}