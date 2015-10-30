# PlisFramework
### Options Available
In any node you can use the basic 3

   ```php
   $options=['attributes'=>[],'removeAttributes'=>[],'children'=>[]].
   ```
   
    - 'attributes' this option takes an array of attributes exp. ['id'=>'myId','class'=>'someClass']
    - 'removeAttributes' this option is used to remove default attributes of Plis components, this option takes an array of attributes to be removed [class'=>'classToRemove']
    - 'children' you can add children to a node via the options, this option takes an array of Node elements [new Node(),new Node()]