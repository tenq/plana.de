<?php

namespace Brainson\Scaffold;

use \Brainson\Scaffold\Slot as Slot;

class ScaffoldContainer
{

    private static array $slots = [];

    public static function getSlot($slotName): Slot
    {
        if (!array_key_exists($slotName, self::$slots)) throw new \Exception("Slot '" . $slotName .  "' not registered");

        return self::$slots[$slotName];
    }

    public static function registerSlot(Slot $slot)
    {
        self::$slots[$slot->getName()] = $slot;
    }

    public static function getregisteredSlots(): array
    {
        return self::$slots;
    }
}
