<?php
namespace OG\InversaBundle\Controller;

class Util
{
    static function asArray($collection)
    {
        $result = array();
        foreach ($collection as $item) {
            $result[] = $item;
        }
        return $result;
    }

    static function syncItems($em, $oldCollection, $newCollection)
    {
        foreach (Util::getItemsToRemove($oldCollection, $newCollection) as $item) {
            $newCollection->removeElement($item);
            $em->remove($item);
        }

    }

    static function getItemsToRemove($oldCollection, $newCollection)
    {
        $toDelete = array();
        foreach ($oldCollection as $oldItem) {
            if (!Util::containsItem($oldItem, $newCollection)) {
                $toDelete[] = $oldItem;
            }
        }
        return $toDelete;
    }

    static function containsItem($item, $collection)
    {
        foreach ($collection as $collItem) {
            if ($collItem->getId() === $item->getId()) {
                return true;
            }
        }
        return false;
    }
}
