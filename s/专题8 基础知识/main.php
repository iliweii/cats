<h3 class="text-center">Operating Systems Basic Concepts and Principles</h3>
<table class="table table-bordered table-hover table-sm">
    <thead>
        <tr class="text-center">
            <th scope="col">Chapter</th>
            <th scope="col">Questions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>操作系统的设计目标：方便性；有效性；可扩充性；开放性。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>方便性和有效性是操作系统设计中最重要的两个目标。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>1990年后，开放性已成为新系统或软件能否被广泛应用的至关重要的因素。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>操作系统的基本特征：并发性：共享性；虚拟性；异步性。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>并发性和共享性是多用户、多任务操作系统两个最基本的特征。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>并发性是多用户、多任务操作系统最重要的特征。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>在OS基本特征中，异步性是指进程是以人们不可预知的速度向前推进的。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>操作系统基本类型：批处理系统；分时系统；实时系统。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td> 在操作系统基本类型中，可靠性是实时系统最重要的特征。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>操作系统的主要功能：处理机管理；存储器管理；设备管理；文件管理；用户接口。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>操作系统的用户接口：命令接口；程序接口：图形用户接口。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>在操作系统接口中，程序接口亦称为系统调用。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>目前比较流行的操作系统（实例)：Windows；UNIX；Linux。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>UNIX系统最本质的特征（英文缩写)：OSI。</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>UNIX系统的内核结构可分成两大部分：进程控制子系统；文件子系统。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>进程三种基本状态：就绪状态；执行状态，阻塞状态。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>进程所请求的一次I/O完成后，将使进程状态从阻察状态变为就绪状态。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>操作系统中处于执行状态的进程时间片用完后，进程状态将转变为就绪状态。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>操作系统中处于执行状态的进程提出I/O请求后，进程状态将转变为阻塞状态。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>进程三种基本状态中，就绪状态是指进程已分配到除CPU以外的所有必要资源。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>进程同步机制应遵循的准则：空闲让进；忙则等待：有限等待；让权等待。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>同步机制准则中，让权等待是指当进程不能进入自己的临界区时，应立即释放处理机。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>进程、文件、线程在系统中存在的唯一标志（英文缩写）：PCB；FCB；TCB。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>在文件系统中，文件属性信息存储在数据结构(英文缩写)FCB中。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>操作系统利用数据结构(英文缩写)PCB描述进程的基本情况和活动过程。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>系统将被中断进程的CPU现场信息保存在该进程的数据结构(英文缩写)PCB中。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>在操作系统中，实现进程同步的机制：信号量机制；管程机制。</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>1965年．荷兰学者Dijkstra提出的信号量机制是一种卓有成效的进程同步工具。</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>产生进程死锁的必要条件：互斥条件：请求和保持条件；不剥夺条件；环路等待条件。</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>在死锁的条件中，不剥夺条件是指进程已获得的资源只能在使用完时由自己释放。</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>在死锁的条件中，互斥条件是指在一段时间内，某资源只能被一个进程占用。</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>资源的按序分配法是摒弃死锁条件中的环路等待条件来预防死锁的发生。</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>现代操作系统产生死领的条件中，互斥条件是不能被摒弃来预防死锁的发生。</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>抢占式进程调度方式基于的主要原则：优先权原则；短进程优先原则；时间片原则。</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>通常采用解除死锁的两种方法：剥夺资源：撤消进程。</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>产生进程死锁的原因可归结为两点：竞争资源；进程间推进顺序非法。</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>1968年，Peter J. Denning指出程序执行时呈现出：时间局限性；空间局限性。</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>虚拟存储器的理论依据：局部性原理。</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>在局部性原理中，产生时间局限性的典型原因是在程序中存在若大量的循环操作。</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>在局部性原理中，产生空间局限性的典型情况是程序的顺序执行。</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>请求分页系统的主要硬件支持：请求页表机制：缺页中断机构：地址变换机构。</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>在请求分页系统的硬件支持中，当所要访问的页面不在内存时，由缺页中断机构实现。</td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>在请求分页系统的硬件支持中，页面置换算法需要应用请求页表机制实现。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>设备分配中的主要数据结构（英文缩写）：DCT；COCT：CHCT；SDT。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>为了实现设备的独立性，系统必须设置(英文缩写)：LUT。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>在设备分配中，用于记录每一个设备情况的数据结构(英文缩写)：DCT。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>在设备分配中，用于记录全部设备情况的数据结构(英文缩写)：SDT。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>在设备分配中，用于记录每一个控制器情况的数据结构(英义缩写)：COCT。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>解决通道“瓶颈”问题最有效的方法是增加设备到主机间的通路。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>按设备的固有属性分类，将I/O设备分为：独占设备；共享设备；虚拟设备。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>将一台物理I/O设备虚拟为多台逻辑I/O设备的技术：SPOOLing。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>按设备的固有属性分类中，独占设备属于临界资源，即进程临界区访问的资源。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>按设备的固有属性分类中，典型的独占设备有打印机、磁带机等。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>按设备的固有属性分类中，典型的共享设备有磁盘、光盘等。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>在假脱机打印机系统中，按设备的固有属性分类，是将独占设备改造为共享设备。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>在假脱机打印机系统中，按设备的固有属性分类，实现了虚拟设备功能。</td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>SPOOLing技术是对脱机I/O系统的模拟，或称为假脱机技术。</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>目录管理的主要功能：按名存取；提高检索速度；文件共享；允许文件重名。</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>在索引节点中设置链接引用(links)计数的目的是为了实现目录管理的文件共享功能。</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>实现“按名存取”是文件系统目录管理中最基本的功能。</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>实现“按名存取”是文件系统向用户提供的最基本的服务。</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>影响文件安全性的主要因素：人为因素；系统因素；自然因素。</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>保证文件系统安全性的主要措施：存取控制；容错技术；后备系统。</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>通过建立后备系统，防止由自然因素所造成的文件系统的不安全性。</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>通过存取控制机制，防止由人为因素所造成的文件系统的不安全性。</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>通过采取容错技术，防止由系统因素所造成的文件系统的不安全性。</td>
        </tr>
        <tr>
            <th scope="row">6</th>
            <td>目前，常用的文件（外存）分配方法：连续分配：链接分配；索引分配。</td>
        </tr>

    </tbody>
</table>